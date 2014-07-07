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

use Illuminate\Support\Collection;
use GrahamCampbell\CoreAPI\Models\AbstractModel;

/**
 * This is the zone model class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */
class Zone extends AbstractModel
{
    /**
     * The zone name.
     *
     * @var string
     */
    protected $zone;

    /**
     * Create a new model instance.
     *
     * @param  \GuzzleHttp\Command\Guzzle\GuzzleClient  $client
     * @param  string  $zone
     * @param  array   $cache
     * @return void
     */
    public function __construct(GuzzleClient $client, $zone, array $cache = array())
    {
        parent::__construct($client);

        $this->zone = $zone;
        $this->cache = $cache;
    }

    /**
     * Get the traffic information.
     *
     * @param  int  $time
     * @return array
     */
    public function traffic($time = 20)
    {
        $stats = $this->get('stats', array('interval' => $time));

        return array_get($stats, 'response.result.objs.0.trafficBreakdown');
    }

    /**
     * Get the bandwidth information.
     *
     * @param  int  $time
     * @return array
     */
    public function bandwidth($time = 20)
    {
        $stats = $this->get('stats', array('interval' => $time));

        return array_get($stats, 'response.result.objs.0.bandwidthServed');
    }

    /**
     * Get the requests information.
     *
     * @param  int  $time
     * @return array
     */
    public function requests($time = 20)
    {
        $stats = $this->get('stats', array('interval' => $time));

        return array_get($stats, 'response.result.objs.0.requestsServed');
    }

    public function userSecurity()
    {
        return $this->setting('userSecuritySetting');
    }

    public function devMode()
    {
        return $this->setting('dev_mode');
    }

    public function ipVersion()
    {
        return $this->setting('ipv46');
    }

    public function alwaysOnline()
    {
        return $this->setting('ob');
    }

    public function cacheLevel()
    {
        return $this->setting('cache_lvl');
    }

    public function outboundLinks()
    {
        return $this->setting('outboundLinks');
    }

    public function async()
    {
        return $this->setting('async');
    }

    public function browserChecking()
    {
        return $this->setting('bic');
    }

    public function challengeTtl()
    {
        return $this->setting('chl_ttl');
    }

    public function expireTtl()
    {
        return $this->setting('exp_ttl');
    }

    public function hotlinking()
    {
        return $this->setting('hotlink');
    }

    public function autoResizing()
    {
        return $this->setting('img');
    }

    public function lazyLoading()
    {
        return $this->setting('lazy');
    }

    public function minification()
    {
        return $this->setting('minify');
    }

    public function outlinking()
    {
        return $this->setting('outlink');
    }

    public function preloading()
    {
        return $this->setting('preload');
    }

    public function smartErrors()
    {
        return $this->setting('s404');
    }

    public function securityLevel()
    {
        return $this->setting('sec_lvl');
    }

    public function spdy()
    {
        return $this->setting('spdy');
    }

    public function ssl()
    {
        return $this->setting('ssl');
    }

    public function wafProfile()
    {
        return $this->setting('waf_profile');
    }

    /**
     * Get the ips information.
     *
     * @param  int  $time
     * @return array
     */
    public function ips($hours = 24, $class = null)
    {
        $zoneIps = $this->get('zoneIps', $this->data(compact('hours', 'class')));

        $ips = array_get($zoneIps, 'response.ips');

        $all = new Collection();

        foreach($ips as $ip) {
            $name = $ip['ip'];
            $zoneIp = new ZoneIP($this->client, $name, $this, array('zoneIp' => $ip));
            $all->put($name, $zoneIp);
        }

        return $all;
    }

    /**
     * Get the data to make a request.
     *
     * @param  array  $data
     * @return array
     */
    protected function data(array $data = array())
    {
        return array_merge(array('z' => $this->zone), $data);
    }

    protected function setting($name)
    {
        $zoneSettings = $this->get('zoneSettings');

        return array_get($zoneSettings, 'response.result.objs.0.'.$name);
    }
}
