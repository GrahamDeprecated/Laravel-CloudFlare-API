<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlareAPI;

use GrahamCampbell\CloudFlareAPI\Providers\IpProvider;
use GrahamCampbell\CloudFlareAPI\Providers\ZoneProvider;

/**
 * This is the cloudflare api class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
