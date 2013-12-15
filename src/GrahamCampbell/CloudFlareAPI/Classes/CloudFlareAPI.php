<?php namespace GrahamCampbell\CloudFlareAPI\Classes;

/**
 * This file is part of Laravel CloudFlare API by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @license    Apache License
 * @copyright  Copyright 2013 Graham Campbell
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */

use GrahamCampbell\CoreAPI\Classes\CoreAPI;
use Illuminate\Cache\CacheManager;
use Illuminate\Config\Repository;

class CloudFlareAPI extends CoreAPI
{
    /**
     * The token.
     *
     * @var string
     */
    protected $token;

    /**
     * The email.
     *
     * @var string
     */
    protected $email;

    /**
     * The domain.
     *
     * @var string
     */
    protected $domain;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Cache\CacheManager  $cache
     * @param  \Illuminate\Config\Repository   $config
     * @return void
     */
    public function __construct(CacheManager $cache, Repository $config)
    {
        parent::__construct($cache, $config);

        $this->token = $this->config['cloudflare-api::token'];
        $this->email = $this->config['cloudflare-api::email'];
        $this->domain = $this->config['cloudflare-api::domain'];

        $this->setup($this->config['cloudflare-api::baseurl']);
    }

    /**
     * Reset the base url.
     *
     * @return string
     */
    public function resetBaseUrl()
    {
        $this->setBaseUrl($this->config['cloudflare-api::baseurl']);
    }

    /**
     * Get the token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the token.
     *
     * @param  string  $token
     * @return void
     */
    public function setToken($token)
    {
        if (!is_string($token)) {
            $baseurl = '';
        }

        $this->token = $token;
    }

    /**
     * Reset the token.
     *
     * @return void
     */
    public function resetToken()
    {
        $this->token = $this->config['cloudflare-api::token'];
    }

    /**
     * Get the email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email.
     *
     * @param  string  $email
     * @return void
     */
    public function setEmail($email)
    {
        if (!is_string($email)) {
            $baseurl = '';
        }

        $this->email = $email;
    }

    /**
     * Reset the email.
     *
     * @return void
     */
    public function resetEmail()
    {
        $this->email = $this->config['cloudflare-api::email'];
    }

    /**
     * Get the domain.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set the domain.
     *
     * @param  string  $domain
     * @return void
     */
    public function setDomain($domain)
    {
        if (!is_string($domain)) {
            $baseurl = '';
        }

        $this->domain = $domain;
    }

    /**
     * Reset the domain.
     *
     * @return void
     */
    public function resetDomain()
    {
        $this->domain = $this->config['cloudflare-api::domain'];
    }

    /**
     * Send a request.
     *
     * @param  array     $data
     * @param  bool      $domain
     * @param  bool|int  $cache
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function request($data, $domain = true, $cache = false)
    {
        $data['tkn']   = $this->token;
        $data['email'] = $this->email;

        if ($domain) {
            $data['z'] = $this->domain;
        }

        $response = $this->post($this->baseurl, null, $data, array(), $cache);

        try {
            $body = $response->json();
        } catch (\Exception $e) {}

        if (isset($body) && is_array($body)) {
            if ($body['result'] !== 'success') {
                $e = CloudFlareAPIException::factory($response->getRequest(), $response->getResponse());
                throw $e;
            } else {
                return $response;
            }
        } else {
            $e = CloudFlareAPIException::factory($response->getRequest(), $response->getResponse());
            throw $e;
        }
    }

    public function apiStats($interval = 20)
    {
        return $this->request(array(
            'a'        => 'stats',
            'interval' => $interval
        ), true, 60);
    }

    public function apiListZones()
    {
        return $this->request(array(
            'a' => 'zone_load_multi'
        ), false, 5);
    }

    public function apiLoadRecords()
    {
        return $this->request(array(
            'a' => 'rec_load_all'
        ), true, 5);
    }

    public function apiZoneCheck($zones)
    {
        if (is_array($zones)) {
            $values = $zones;
        } else {
            $values[] = $zones;
        }
        return $this->request(array(
            'a'     => 'zone_check',
            'zones' => implode(',', $values)
        ), false, 5);
    }

    public function apiZoneIPs($hours = 24, $class = 'r', $geo = false)
    {
        return $this->request(array(
            'a'     => 'zone_ips',
            'hours' => $hours,
            'class' => $class,
            'geo'   => (int)$geo
        ), true, 5);
    }

    public function apiIPLookup($ip)
    {
        return $this->request(array(
            'a'  => 'ip_lkup',
            'ip' => $ip
        ), false, 5);
    }

    public function apiZoneSettings()
    {
        return $this->request(array(
            'a' => 'zone_settings'
        ), true, 5);
    }

    public function apiSecurityLevel($v)
    {
        return $this->request(array(
            'a' => 'sec_lvl',
            'v' => $v
        ));
    }

    public function apiCacheLevel($v)
    {
        return $this->request(array(
            'a' => 'cache_lvl',
            'v' => $v
        ));
    }

    public function apiDevMode($v)
    {
        return $this->request(array(
            'a' => 'devmode',
            'v' => (int)$v
        ));
    }

    public function apiFullPurge()
    {
        return $this->request(array(
            'a' => 'fpurge_ts',
            'v' => (int)true
        ));
    }

    public function apiFilePurge($url)
    {
        return $this->request(array(
            'a'   => 'zone_file_purge',
            'url' => $url
        ));
    }

    public function apiZoneGrab($zid)
    {
        return $this->request(array(
            'a'   => 'zone_grab',
            'zid' => $zid
        ), false);
    }

    public function apiWhitelist($key)
    {
        return $this->request(array(
            'a'   => 'wl',
            'key' => $key
        ), false);
    }

    public function apiBan($key)
    {
        return $this->request(array(
            'a'   => 'ban',
            'key' => $key
        ), false);
    }

    public function apiNull($key)
    {
        return $this->request(array(
            'a'   => 'nul',
            'key' => $key
        ), false);
    }

    public function apiIPv6($v)
    {
        return $this->request(array(
            'a' => 'ipv46',
            'v' => (int)$v
        ));
    }

    public function apiASync($v)
    {
        return $this->request(array(
            'a' => 'async',
            'v' => $v
        ));
    }

    public function apiMinify($v)
    {
        return $this->request(array(
            'a' => 'minify',
            'v' => $v
        ));
    }

    public function apiMirage($v)
    {
        return $this->request(array(
            'a' => 'mirage2',
            'v' => (int)$v
        ));
    }

    public function apiNewRecord(array $data)
    {
        $data['a'] = 'rec_new';
        return $this->request($data);
    }

    public function apiEditRecord(array $data)
    {
        $data['a'] = 'rec_edit';
        return $this->request($data);
    }

    public function apiDeleteRecord($id)
    {
        return $this->request(array(
            'a'  => 'rec_delete',
            'id' => $id
        ));
    }
}
