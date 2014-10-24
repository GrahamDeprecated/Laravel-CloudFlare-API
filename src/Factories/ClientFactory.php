<?php

/**
 * This file is part of Laravel CloudFlare API by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\CloudFlareAPI\Factories;

use GrahamCampbell\CloudFlareAPI\Subscribers\ErrorSubscriber;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber;

/**
 * This is the client factory class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
class ClientFactory
{
    /**
     * Make a new guzzle services client.
     *
     * @param string[] $config
     *
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    public function make(array $config)
    {
        $client = $this->makeBaseClient($config);

        return $this->makeServicesClient($client);
    }

    /**
     * Make a guzzle client.
     *
     * @param string[] $config
     *
     * @return \GuzzleHttp\Client
     */
    protected function makeBaseClient($config)
    {
        $parameters = $this->getParameters($config);

        $client = new Client($parameters);

        $this->attachSubscribers($client);

        return $client;
    }

    /**
     * Get the client constructor parameters.
     *
     * @param string[] $config
     *
     * @return array
     */
    protected function getParameters(array $config)
    {
        $config = $this->getConfig($config);

        return array(
            'base_url' => 'https://www.cloudflare.com/api_json.html',
            'defaults' => array('query' => array('tkn' => $config['token'], 'email' => $config['email'])),
        );
    }

    /**
     * Get the configuration.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('token', $config) || !array_key_exists('email', $config)) {
            throw new \InvalidArgumentException('The cloudflare client requires configuration.');
        }

        return array_only($config, array('token', 'email'));
    }

    /**
     * Attach all subscribers to the guzzle client.
     *
     * @param \GuzzleHttp\Client $client
     *
     * @return \GuzzleHttp\Client
     */
    protected function attachSubscribers(Client $client)
    {
        $subscribers = $this->getSubscribers();

        foreach ($subscribers as $subscriber) {
            $client->getEmitter()->attach($subscriber);
        }

        return $client;
    }

    /**
     * Get all subscribers.
     *
     * @return \GuzzleHttp\Event\SubscriberInterface[]
     */
    protected function getSubscribers()
    {
        $subsribers = array();

        $names = $this->getSubscriberNames();

        foreach ($names as $name) {
            $subsribers[] = $this->{"get{$name}Subscriber"}();
        }

        return $subsribers;
    }

    /**
     * Get all subscriber names.
     *
     * @return string[]
     */
    protected function getSubscriberNames()
    {
        return array('Retry', 'CloudFlareAPIError');
    }

    /**
     * Get the retry subscriber.
     *
     * @return \GuzzleHttp\Subscriber\Retry\RetrySubscriber
     */
    protected function getRetrySubscriber()
    {
        $filter = RetrySubscriber::createChainFilter(array(
            RetrySubscriber::createIdempotentFilter(),
            RetrySubscriber::createStatusFilter(),
        ));

        return new RetrySubscriber(array('filter' => $filter));
    }

    /**
     * Get the cloudflare api error subscriber.
     *
     * @return \GrahamCampbell\CloudFlareAPI\Subscribers\ErrorSubscriber
     */
    protected function getErrorSubscriber()
    {
        return new ErrorSubscriber();
    }

    /**
     * Make a new guzzle services client.
     *
     * @param \GuzzleHttp\Client $client
     *
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    protected function makeServicesClient(Client $client)
    {
        $parameters = $this->getDescription();

        $description = new Description($parameters);

        return new GuzzleClient($client, $description);
    }

    /**
     * Get the description constructor parameters.
     *
     * @return array
     */
    protected function getDescription()
    {
        return require 'decription.php';
    }
}
