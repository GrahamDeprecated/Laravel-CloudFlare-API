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
 * This is the abstract model class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
abstract class AbstractModel
{
    /**
     * The guzzle client class.
     *
     * @var \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    protected $client;

    /**
     * The request cache.
     *
     * @var array
     */
    protected $cache;

    /**
     * Create a new model instance.
     *
     * @param \GuzzleHttp\Command\Guzzle\GuzzleClient $client
     * @param array                                   $cache
     *
     * @return void
     */
    public function __construct(GuzzleClient $client, array $cache = [])
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    /**
     * Clear the request cache.
     *
     * @param string|string[] $methods
     *
     * @return $this
     */
    public function clearCache($methods = null)
    {
        if ($methods === null || $methods === 'all') {
            $this->cache = [];
        } else {
            foreach ((array) $methods as $method) {
                $this->cache[$method] = [];
            }
        }

        return $this;
    }

    /**
     * Make a get request.
     *
     * @param string $method
     * @param array  $data
     * @param string $key
     *
     * @return array
     */
    protected function get($method, array $data = [], $key = 'key')
    {
        $data = $this->data($data);

        if (!isset($this->cache[$method][$key])) {
            $this->cache[$method][$key] = $this->client->$method($data);
        }

        return $this->cache[$method][$key];
    }

    /**
     * Make a request.
     *
     * @param string                    $method
     * @param array                     $data
     * @param string|string[]|bool|null $flush
     *
     * @return array
     */
    protected function action($method, array $data = [], $flush = null)
    {
        $data = $this->data($data);

        $this->clearCache($flush);

        return $this->client->$method($data);
    }

    /**
     * Get the data to make a request.
     *
     * @param array $data
     *
     * @return array
     */
    protected function data(array $data = [])
    {
        return $data;
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
