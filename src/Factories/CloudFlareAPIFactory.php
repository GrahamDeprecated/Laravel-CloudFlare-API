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

namespace GrahamCampbell\CloudFlareAPI\Factories;

use GrahamCampbell\CloudFlareAPI\CloudFlareAPI;

/**
 * This is the cloudflare api factory class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */
class CloudFlareAPIFactory
{
    /**
     * The client factory instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Factories\ClientFactory
     */
    protected $client;

    /**
     * Create a new cloudflare api factory instance.
     *
     * @param  \GrahamCampbell\CloudFlareAPI\Factories\ClientFactory  $client
     * @return void
     */
    public function __construct(ClientFactory $client)
    {
        $this->client = $client;
    }

    /**
     * Make a new cloudflare api instance.
     *
     * @param  array  $config
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    public function make(array $config)
    {
        $client = $this->createClient($config);

        return new CloudFlareAPI($client);
    }

    /**
     * Get a new guzzle client.
     *
     * @param  array  $config
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    public function createClient(array $config)
    {
        return $this->client->make($config);
    }

    /**
     * Get the client factory instance.
     *
     * @return \GrahamCampbell\CloudFlareAPI\Factories\ClientFactory
     */
    public function getClient()
    {
        return $this->client;
    }
}
