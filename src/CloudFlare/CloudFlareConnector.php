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
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GrahamCampbell\Manager\Interfaces\ConnectorInterface;

/**
 * This is the cloudflare connector class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */
class CloudFlareConnector implements ConnectorInterface
{
    /**
     * The guzzle client instance.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Create a new cloudflare connector instance.
     *
     * @param  \GuzzleHttp\ClientInterface   $client
     * @return void
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Establish an adapter connection.
     *
     * @param  array  $config
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    public function connect(array $config)
    {
        $parameters = $this->getParameters();

        return $this->getGuzzleClient($config);
    }

    /**
     * Get the description constructor parameters.
     *
     * @return array
     */
    protected function getParameters()
    {
        return array(
            'operations' => array(
                // TODO
            ),
            'models' => array(
                'jsonResponse' => array(
                    'type' => 'object',
                    'additionalProperties' => array(
                        'location' => 'json'
                    )
                )
            )
        );
    }

    /**
     * Get the guzzle client.
     *
     * @param  array  $parameters
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    protected function getGuzzleClient($parameters)
    {
        $description = new Description($parameters);

        return new GuzzleClient($this->client, $description);
    }

    /**
     * Get the guzzle client instance.
     *
     * @return \GuzzleHttp\ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
}
