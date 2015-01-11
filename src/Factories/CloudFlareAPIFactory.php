<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlareAPI\Factories;

use GrahamCampbell\CloudFlareAPI\CloudFlareAPI;
use GrahamCampbell\CloudFlareAPI\Repositories\IpRepository;
use GrahamCampbell\CloudFlareAPI\Repositories\ZoneRepository;

/**
 * This is the cloudflare api factory class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CloudFlareAPIFactory
{
    /**
     * The client factory instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Factories\ClientFactory
     */
    protected $client;

    /**
     * Create a new cloudflare api factory instance.
     *
     * @param \GrahamCampbell\CloudFlareAPI\Factories\ClientFactory $client
     *
     * @return void
     */
    public function __construct(ClientFactory $client)
    {
        $this->client = $client;
    }

    /**
     * Make a new api instance.
     *
     * @param string[] $config
     *
     * @return \GrahamCampbell\CloudFlareAPI\CloudFlareAPI
     */
    public function make(array $config)
    {
        $client = $this->createClient($config);
        $zone = new ZoneRepository($client);
        $ip = new IpRepository($client);

        return new CloudFlareAPI($zone, $ip);
    }

    /**
     * Get a new guzzle client.
     *
     * @param string[] $config
     *
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    public function createClient(array $config)
    {
        return $this->client->make($config);
    }

    /**
     * Get the client factory instance.
     *
     * @return \GrahamCampbell\CloudFlareAPI\Factories\ClientFactory
     */
    public function getClient()
    {
        return $this->client;
    }
}
