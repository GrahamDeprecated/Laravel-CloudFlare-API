<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlareAPI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the cloudflare api facade class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CloudFlareAPI extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cloudflareapi';
    }
}
