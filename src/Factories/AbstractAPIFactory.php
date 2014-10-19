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

/**
 * This is the abstract api factory class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
abstract class AbstractAPIFactory
{
    /**
     * The client factory instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Factories\AbstractClientFactory
     */
    protected $client;

    /**
     * Create a new api factory instance.
     *
     * @param \GrahamCampbell\CloudFlareAPI\Factories\AbstractClientFactory $client
     *
     * @return void
     */
    public function __construct(AbstractClientFactory $client)
    {
        $this->client = $client;
    }

    /**
     * Make a new api instance.
     *
     * @param string[] $config
     *
     * @return \GrahamCampbell\CloudFlareAPI\AbstractAPI
     */
    public function make(array $config)
    {
        $client = $this->createClient($config);

        $class = $this->getClassName();

        return new $class($client);
    }

    /**
     * Get the api class name.
     *
     * @return string
     */
    abstract protected function getClassName();

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
     * @return \GrahamCampbell\CloudFlareAPI\Factories\AbstractClientFactory
     */
    public function getClient()
    {
        return $this->client;
    }
}
