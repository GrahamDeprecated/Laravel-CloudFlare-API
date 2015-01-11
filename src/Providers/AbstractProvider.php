<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlareAPI\Providers;

use GuzzleHttp\Command\Guzzle\GuzzleClient;

/**
 * This is the abstract provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
abstract class AbstractProvider
{
    /**
     * The guzzle client class.
     *
     * @var \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    protected $client;

    /**
     * Create a new provider instance.
     *
     * @param \GuzzleHttp\Command\Guzzle\GuzzleClient $client
     *
     * @return void
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get the guzzle client instance.
     *
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    public function getClient()
    {
        return $this->client;
    }
}
