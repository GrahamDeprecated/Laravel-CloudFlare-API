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

use GrahamCampbell\CloudFlareAPI\Models\Ip;

/**
 * This is the ip repository class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class IpRepository extends AbstractRepository
{
    /**
     * Get a single ip object.
     *
     * @param string $ip
     *
     * @return \GrahamCampbell\CloudFlareAPI\Models\Ip
     */
    public function get($ip)
    {
        return new Ip($this->client, $ip);
    }
}
