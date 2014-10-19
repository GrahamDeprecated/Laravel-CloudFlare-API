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

namespace GrahamCampbell\CloudFlareAPI;

use GrahamCampbell\CloudFlareAPI\Factories\AbstractAPIFactory;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Config\Repository;

/**
 * This is the abstract api manager class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
abstract class AbstractAPIManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Factories\AbstractAPIFactory
     */
    protected $factory;

    /**
     * Create a new api manager instance.
     *
     * @param \Illuminate\Config\Repository                              $config
     * @param \GrahamCampbell\CloudFlareAPI\Factories\AbstractAPIFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, AbstractAPIFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \GrahamCampbell\CloudFlareAPI\AbstractAPI
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the factory instance.
     *
     * @return \GrahamCampbell\CloudFlareAPI\Factories\AbstractAPIFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
