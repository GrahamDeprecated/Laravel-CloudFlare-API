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

namespace GrahamCampbell\CloudFlareAPI\Managers;

use Illuminate\Config\Repository;
use GrahamCampbell\Manager\Managers\AbstractManager;
use GrahamCampbell\CloudFlareAPI\CloudFlare\ConnectionFactory;

/**
 * This is the cloudflare api manager class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */
class CloudFlareAPIManager extends AbstractManager
{
    /**
     * The connection factory instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\CloudFlare\ConnectionFactory
     */
    protected $factory;

    /**
     * Create a new cloudflare api manager instance.
     *
     * @param  \Illuminate\Config\Repository   $config
     * @param  \GrahamCampbell\CloudFlareAPI\CloudFlare\ConnectionFactory  $factory
     * @return void
     */
    public function __construct(Repository $config, ConnectionFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param  array  $config
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClientInterface
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'graham-campbell/cloudflare-api';
    }

    /**
     * Get the factory instance.
     *
     * @return \GrahamCampbell\CloudFlareAPI\CloudFlare\ConnectionFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
