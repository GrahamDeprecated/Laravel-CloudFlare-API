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

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber;

/**
 * This is the abstract client factory class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
abstract class AbstractClientFactory
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

        return $this->attachSubscribers($client);
    }

    /**
     * Get the client constructor parameters.
     *
     * @param string[] $config
     *
     * @return array
     */
    abstract protected function getParameters(array $config);

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
        return array('Retry');
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
    abstract protected function getDescription();
}
