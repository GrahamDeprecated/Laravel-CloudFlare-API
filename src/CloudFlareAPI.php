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

use GrahamCampbell\CloudFlareAPI\Repositories\IpRepository;
use GrahamCampbell\CloudFlareAPI\Repositories\ZoneRepository;

/**
 * This is the cloudflare api class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CloudFlareAPI
{
    /**
     * The zone repository instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Repositories\ZoneRepository
     */
    protected $zone;

    /**
     * The ip repository instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Repositories\IpRepository
     */
    protected $ip;

    /**
     * Create a new cloudflare api instance.
     *
     * @param \GrahamCampbell\CloudFlareAPI\Repositories\ZoneRepository $zone
     * @param \GrahamCampbell\CloudFlareAPI\Repositories\IpRepository   $ip
     *
     * @return void
     */
    public function __construct(ZoneRepository $zone, IpRepository $ip)
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
