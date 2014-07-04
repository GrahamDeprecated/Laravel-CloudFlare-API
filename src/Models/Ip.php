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

namespace GrahamCampbell\CloudFlareAPI\Models;

use GrahamCampbell\CoreAPI\Models\AbstractModel;

/**
 * This is the ip model class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */
class Ip extends AbstractModel
{
    /**
     * The ip address.
     *
     * @var string
     */
    protected $ip;

    /**
     * Create a new model instance.
     *
     * @param  \GuzzleHttp\Command\Guzzle\GuzzleClient  $client
     * @param  string  $ip
     * @param  array   $cache
     * @return void
     */
    public function __construct(GuzzleClient $client, $ip, array $cache = array())
    {
        parent::__construct($client, $cache);

        $this->ip = $ip;
    }

    public function ip()
    {
        return $this->ip;
    }

    public function score()
    {
        $ipLkup = $this->get('ipLkup', array('ip' => $this->ip));

        return $ipLkup['response'][$this->ip];
    }

    public function whitelist()
    {
        $this->post('wl', array('key' => $this->ip), false);

        return $this;
    }

    public function ban()
    {
        $this->post('ban', array('key' => $this->ip), false);

        return $this;
    }

    public function unlist()
    {
        $this->post('nul', array('key' => $this->ip), false);

        return $this;
    }
}
