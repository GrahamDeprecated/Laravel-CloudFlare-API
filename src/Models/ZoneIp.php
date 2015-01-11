<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlareAPI\Models;

use GuzzleHttp\Command\Guzzle\GuzzleClient;

/**
 * This is the zone ip model class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class ZoneIp extends Ip
{
    /**
     * The zone object.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Models\Zone
     */
    protected $zone;

    /**
     * Create a new model instance.
     *
     * @param \GuzzleHttp\Command\Guzzle\GuzzleClient   $client
     * @param string                                    $ip
     * @param \GrahamCampbell\CloudFlareAPI\Models\Zone $zone
     * @param array                                     $cache
     *
     * @return void
     */
    public function __construct(GuzzleClient $client, $ip, Zone $zone, array $cache = [])
    {
        parent::__construct($client, $ip, $cache);

        $this->zone = $zone;
    }

    /**
     * Get the threat classification.
     *
     * @return string
     */
    public function getClassification()
    {
        return (string) $this->lookup('classification');
    }

    /**
     * Get the number of hits.
     *
     * @return int
     */
    public function getHits()
    {
        return (int) $this->lookup('hits');
    }

    /**
     * Get the latitude.
     *
     * @return int
     */
    public function getLatitude()
    {
        return (int) $this->lookup('latitude');
    }

    /**
     * Get the longitude.
     *
     * @return int
     */
    public function getLongitude()
    {
        return (int) $this->lookup('longitude');
    }

    /**
     * Lookup information.
     *
     * @param string $key
     *
     * @return mixed
     */
    protected function lookup($key)
    {
        if (!$this->cache['zoneIp']) {
            $data = ['z' => $this->zone->getZone()];
            $ips = $this->client->zoneIps($this->data($data))['response']['ips'];
            foreach ($ips as $ip) {
                if ($ip['ip'] == $this->ip) {
                    $this->cache['zoneIp'] = $ip;
                    break;
                }
            }
        }

        return $this->cache['zoneIp'][$key];
    }

    /**
     * Get the zone instance.
     *
     * @return \GrahamCampbell\CloudFlareAPI\Models\Zone
     */
    public function getZone()
    {
        return $this->zone;
    }
}
