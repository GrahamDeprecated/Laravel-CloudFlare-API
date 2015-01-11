<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
 * @author Graham Campbell <graham@mineuk.com>
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

        return [
            'base_url' => 'https://www.cloudflare.com/api_json.html',
            'defaults' => ['query' => ['tkn' => $config['token'], 'email' => $config['email']]],
        ];
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

        return array_only($config, ['token', 'email']);
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
        $client->getEmitter()->attach($this->getRetrySubscriber());
        $client->getEmitter()->attach($this->getErrorSubscriber());

        return $client;
    }

    /**
     * Get the retry subscriber.
     *
     * @return \GuzzleHttp\Subscriber\Retry\RetrySubscriber
     */
    protected function getRetrySubscriber()
    {
        $filter = RetrySubscriber::createChainFilter([
            RetrySubscriber::createIdempotentFilter(),
            RetrySubscriber::createStatusFilter(),
        ]);

        return new RetrySubscriber(['filter' => $filter]);
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
        return require 'description.php';
    }
}
