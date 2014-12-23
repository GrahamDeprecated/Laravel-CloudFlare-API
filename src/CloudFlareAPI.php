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

namespace GrahamCampbell\CloudFlareAPI;

use GrahamCampbell\CloudFlareAPI\Providers\IpProvider;
use GrahamCampbell\CloudFlareAPI\Providers\ZoneProvider;

/**
 * This is the cloudflare api class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
class CloudFlareAPI
{
    /**
     * The zone provider instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Providers\ZoneProvider
     */
    protected $zone;

    /**
     * The ip provider instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Providers\IpProvider
     */
    protected $ip;

    /**
     * Create a new cloudflare api instance.
     *
     * @param \GrahamCampbell\CloudFlareAPI\Providers\ZoneProvider $zone
     * @param \GrahamCampbell\CloudFlareAPI\Providers\IpProvider   $ip
     *
     * @return void
     */
    public function __construct(ZoneProvider $zone, IpProvider $ip)
    {
        $this->zone = $zone;
        $this->ip = $ip;
    }

    /**
     * Get a collection of all the zones.
     *
     * @return \Illuminate\Support\Collection
     */
    public function zones()
    {
        return $this->zone->all();
    }

    /**
     * Get a single zone object.
     *
     * @param string $zone
     *
     * @return \GrahamCampbell\CloudFlareAPI\Models\Zone
     */
    public function zone($zone)
    {
        return $this->zone->get($zone);
    }

    /**
     * Get a single ip object.
     *
     * @param string $ip
     *
     * @return \GrahamCampbell\CloudFlareAPI\Models\Ip
     */
    public function ip($ip)
    {
        return $this->ip->get($ip);
    }
}
