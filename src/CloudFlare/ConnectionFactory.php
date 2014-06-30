<?php

/**
 * This file is part of Laravel CloudFlare API by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\CloudFlareAPI\CloudFlare;

use GuzzleHttp\ClientInterface;
use GrahamCampbell\CloudFlareAPI\Clients\ConnectionFactory as ClientFactory;

/**
 * This is the cloudflare connection factory class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */
class ConnectionFactory
{
    /**
     * The client factory instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Clients\ConnectionFactory
     */
    protected $client;

    /**
     * Create a new cloudflare connection factory instance.
     *
     * @param  \GrahamCampbell\Flysystem\Adapters\ConnectionFactory  $client
     * @return void
     */
    public function __construct(ClientFactory $client)
    {
        $this->client = $client
    }

    /**
     * Establish a connection based on the configuration.
     *
     * @param  array  $config
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClientInterface
     */
    public function make(array $config)
    {
        $client = $this->createClient($config);

        return $this->createConnector($config, $client)->connect($config);
    }

    /**
     * Establish a client connection.
     *
     * @param  array  $config
     * @return \GuzzleHttp\ClientInterface
     */
    public function createClient(array $config)
    {
        return $this->client->make($config);
    }

    /**
     * Create a connector instance based on the configuration.
     *
     * @param  array  $config
     * @param  \GuzzleHttp\ClientInterface  $client
     * @return \GrahamCampbell\Manager\Interfaces\ConnectorInterface
     */
    public function createConnector(array $config, ClientInterface $client)
    {
        if (!isset($config['driver'])) {
            throw new \InvalidArgumentException("A driver must be specified.");
        }

        switch ($config['driver']) {
            case 'cloudflare':
                return new CloudFlareConnector($client);
        }

        throw new \InvalidArgumentException("Unsupported driver [{$config['driver']}]");
    }

    /**
     * Get the client factory instance.
     *
     * @return \GrahamCampbell\CloudFlareAPI\Clients\ConnectionFactory
     */
    public function getClient()
    {
        return $this->client;
    }
}
