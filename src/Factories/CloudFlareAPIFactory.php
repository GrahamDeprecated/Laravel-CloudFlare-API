<?php

/*
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

use GrahamCampbell\CloudFlareAPI\CloudFlareAPI;
use GrahamCampbell\CloudFlareAPI\Repositories\IpRepository;
use GrahamCampbell\CloudFlareAPI\Repositories\ZoneRepository;

/**
 * This is the cloudflare api factory class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
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
     * @param \GrahamCampbell\CloudFlareAPI\Factories\ClientFactory $client
     *
     * @return void
     */
    public function __construct(ClientFactory $client)
    {
        $this->client = $client;
    }

    /**
     * Make a new api instance.
     *
     * @param string[] $config
     *
     * @return \GrahamCampbell\CloudFlareAPI\CloudFlareAPI
     */
    public function make(array $config)
    {
        $client = $this->createClient($config);
        $zone = new ZoneRepository($client);
        $ip = new IpRepository($client);

        return new CloudFlareAPI($zone, $ip);
    }

    /**
     * Get a new guzzle client.
     *
     * @param string[] $config
     *
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
