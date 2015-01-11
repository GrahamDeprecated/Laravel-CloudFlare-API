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
 * This is the ip model class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Ip extends AbstractModel
{
    /**
     * The ip address.
     *
     * @var string
     */
    protected $ip;

    /**
     * Create a new model instance.
     *
     * @param \GuzzleHttp\Command\Guzzle\GuzzleClient $client
     * @param string                                  $ip
     * @param array                                   $cache
     *
     * @return void
     */
    public function __construct(GuzzleClient $client, $ip, array $cache = [])
    {
        parent::__construct($client, $cache);

        $this->ip = (string) $ip;
    }

    /**
     * Get the ip address.
     *
     * @return string
     */
    public function getIp()
    {
        return (string) $this->ip;
    }

    /**
     * Get the threat score.
     *
     * @return string
     */
    public function getScore()
    {
        $ipLkup = $this->get('ipLkup', ['ip' => $this->ip]);

        $score = $ipLkup['response'][$this->ip];

        if ($score) {
            return (string) $score;
        } else {
            return 'unknown';
        }
    }

    /**
     * Whitelist this ip.
     *
     * @return $this
     */
    public function whitelist()
    {
        $this->action('wl', ['key' => $this->ip], false);

        return $this;
    }

    /**
     * Ban this ip.
     *
     * @return $this
     */
    public function ban()
    {
        $this->action('ban', ['key' => $this->ip], false);

        return $this;
    }

    /**
     * Unlist this ip.
     *
     * @return $this
     */
    public function unlist()
    {
        $this->action('nul', ['key' => $this->ip], false);

        return $this;
    }
}
