<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlareAPI\Repositories;

use GrahamCampbell\CloudFlareAPI\Models\Zone;
use Illuminate\Support\Collection;

/**
 * This is the zone repository class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class ZoneRepository extends AbstractRepository
{
    /**
     * Get a collection of all the zones.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        $multi = $this->client->zoneLoadMulti();

        $zones = array_get($multi, 'response.zones.objs');

        $all = new Collection();

        foreach ($zones as $zone) {
            $name = $zone['zone_name'];
            $all->put($name, $this->get($name));
        }

        return $all;
    }

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
}
