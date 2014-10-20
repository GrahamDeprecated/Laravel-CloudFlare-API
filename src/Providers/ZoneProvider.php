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

namespace GrahamCampbell\CloudFlareAPI\Providers;

use GrahamCampbell\CloudFlareAPI\Models\Zone;
use Illuminate\Support\Collection;

/**
 * This is the zone provider class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
class ZoneProvider extends AbstractProvider
{
    /**
     * Get a single zone object.
     *
     * @param string $zone
     *
     * @return \GrahamCampbell\CloudFlareAPI\Models\Zone
     */
    public function get($zone)
    {
        return new Zone($this->client, $zone);
    }

    /**
     * Get a collection of all the zones.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        $multi = $this->client->zoneLoadMulti();

        $zones = array_get($multi->toArray(), 'response.zones.objs');

        $all = new Collection();

        foreach ($zones as $zone) {
            $name = $zone['zone_name'];
            $all->put($name, $this->get($name));
        }

        return $all;
    }
}