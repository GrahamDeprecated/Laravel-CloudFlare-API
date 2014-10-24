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

namespace GrahamCampbell\CloudFlareAPI\Models;

use GuzzleHttp\Command\Guzzle\GuzzleClient;

/**
 * This is the ip model class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
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
     * @param \GuzzleHttp\Command\Guzzle\GuzzleClient $client
     * @param string                                  $ip
     * @param array                                   $cache
     *
     * @return void
     */
    public function __construct(GuzzleClient $client, $ip, array $cache = array())
    {
        parent::__construct($client, $cache);

        $this->ip = (string) $ip;
    }

    /**
     * Get the ip address.
     *
     * @return string
     */
    public function getIp()
    {
        return (string) $this->ip;
    }

    /**
     * Get the threat score.
     *
     * @return string
     */
    public function getScore()
    {
        $ipLkup = $this->get('ipLkup', array('ip' => $this->ip));

        $score = $ipLkup['response'][$this->ip];

        if ($score) {
            return (string) $score;
        } else {
            return 'unknown';
        }
    }

    /**
     * Whitelist this ip.
     *
     * @return $this
     */
    public function whitelist()
    {
        $this->action('wl', array('key' => $this->ip), false);

        return $this;
    }

    /**
     * Ban this ip.
     *
     * @return $this
     */
    public function ban()
    {
        $this->action('ban', array('key' => $this->ip), false);

        return $this;
    }

    /**
     * Unlist this ip.
     *
     * @return $this
     */
    public function unlist()
    {
        $this->action('nul', array('key' => $this->ip), false);

        return $this;
    }
}
