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

use GrahamCampbell\CloudFlareAPI\Factories\CloudFlareAPIFactory;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the cloudflare api manager class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CloudFlareAPIManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Factories\CloudFlareAPIFactory
     */
    protected $factory;

    /**
     * Create a new cloudflare api manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository                      $config
     * @param \GrahamCampbell\CloudFlareAPI\Factories\CloudFlareAPIFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, CloudFlareAPIFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \GrahamCampbell\CloudFlareAPI\CloudFlareAPI
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'cloudflareapi';
    }

    /**
     * Get the factory instance.
     *
     * @return \GrahamCampbell\CloudFlareAPI\Factories\CloudFlareAPIFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
