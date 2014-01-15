<?php

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
 */

namespace GrahamCampbell\CloudFlareAPI\Classes;

use Illuminate\Cache\CacheManager;
use Illuminate\Config\Repository;
use GrahamCampbell\CoreAPI\Classes\CoreAPI;
use GrahamCampbell\CloudFlareAPI\Exceptions\CloudFlareAPIException;

/**
 * This is the cloudflare api class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */
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
     * @return $this
     */
    public function resetBaseUrl()
    {
        return $this->setBaseUrl($this->config['cloudflare-api::baseurl']);
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
     * @return $this
     */
    public function setToken($token)
    {
        if (!is_string($token)) {
            $token = '';
        }

        $this->token = $token;

        return $this;
    }

    /**
     * Reset the token.
     *
     * @return $this
     */
    public function resetToken()
    {
        return $this->setToken($this->config['cloudflare-api::token']);
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
     * @return $this
     */
    public function setEmail($email)
    {
        if (!is_string($email)) {
            $email = '';
        }

        $this->email = $email;

        return $this;
    }

    /**
     * Reset the email.
     *
     * @return $this
     */
    public function resetEmail()
    {
        return $this->setEmail($this->config['cloudflare-api::email']);
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
     * @return $this
     */
    public function setDomain($domain)
    {
        if (!is_string($domain)) {
            $domain = '';
        }

        $this->domain = $domain;

        return $this;
    }

    /**
     * Reset the domain.
     *
     * @return $this
     */
    public function resetDomain()
    {
        return $this->setDomain($this->config['cloudflare-api::domain']);
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
        } catch (\Exception $e) {
            // ignore the exception
        }

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

    /**
     * Get the stats.
     *
     * @param  int  $interval
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiStats($interval = 20)
    {
        return $this->request(array(
            'a'        => 'stats',
            'interval' => $interval
        ), true, 60);
    }

    /**
     * List the zones.
     *
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiListZones()
    {
        return $this->request(array(
            'a' => 'zone_load_multi'
        ), false, 5);
    }

    /**
     * List the zone records.
     *
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiLoadRecords()
    {
        return $this->request(array(
            'a' => 'rec_load_all'
        ), true, 5);
    }

    /**
     * Checks for active zones.
     *
     * @param  array  $zones
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
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

    /**
     * List zone ip addresses.
     *
     * @param  int     $hours
     * @param  string  $class
     * @param  bool    $geo
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiZoneIPs($hours = 24, $class = 'r', $geo = false)
    {
        return $this->request(array(
            'a'     => 'zone_ips',
            'hours' => $hours,
            'class' => $class,
            'geo'   => (int)$geo
        ), true, 5);
    }

    /**
     * Get information about an ip address.
     *
     * @param  string  $ip
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiIPLookup($ip)
    {
        return $this->request(array(
            'a'  => 'ip_lkup',
            'ip' => $ip
        ), false, 5);
    }

    /**
     * Get zone settings.
     *
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiZoneSettings()
    {
        return $this->request(array(
            'a' => 'zone_settings'
        ), true, 5);
    }

    /**
     * Set the security level.
     *
     * @param  string  $v
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiSecurityLevel($v)
    {
        return $this->request(array(
            'a' => 'sec_lvl',
            'v' => $v
        ));
    }

    /**
     * Set the cache level.
     *
     * @param  string  $v
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiCacheLevel($v)
    {
        return $this->request(array(
            'a' => 'cache_lvl',
            'v' => $v
        ));
    }

    /**
     * Set the dev mode state.
     *
     * @param  bool  $v
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiDevMode($v)
    {
        return $this->request(array(
            'a' => 'devmode',
            'v' => (int)$v
        ));
    }

    /**
     * Purge all files from the cache.
     *
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiFullPurge()
    {
        return $this->request(array(
            'a' => 'fpurge_ts',
            'v' => (int)true
        ));
    }

    /**
     * Purge a single file from the cache.
     *
     * @param  string  $url
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiFilePurge($url)
    {
        return $this->request(array(
            'a'   => 'zone_file_purge',
            'url' => $url
        ));
    }

    /**
     * Update the snapshot of site.
     *
     * @param  int  $zid
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiZoneGrab($zid)
    {
        return $this->request(array(
            'a'   => 'zone_grab',
            'zid' => $zid
        ), false);
    }

    /**
     * Whitelist and ip address.
     *
     * @param  string  $ip
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiWhitelist($ip)
    {
        return $this->request(array(
            'a'   => 'wl',
            'key' => $ip
        ), false);
    }

    /**
     * Blacklist and ip address.
     *
     * @param  string  $ip
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiBlacklist($ip)
    {
        return $this->request(array(
            'a'   => 'ban',
            'key' => $ip
        ), false);
    }

    /**
     * Null and ip address.
     *
     * @param  string  $ip
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiNull($ip)
    {
        return $this->request(array(
            'a'   => 'nul',
            'key' => $ip
        ), false);
    }

    /**
     * Set the ipv6 state.
     *
     * @param  bool  $v
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiIPv6($v)
    {
        return $this->request(array(
            'a' => 'ipv46',
            'v' => (int)$v
        ));
    }

    /**
     * Set the async state.
     *
     * @param  string  $v
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiASync($v)
    {
        return $this->request(array(
            'a' => 'async',
            'v' => $v
        ));
    }

    /**
     * Set the minification mode.
     *
     * @param  int  $v
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiMinify($v)
    {
        return $this->request(array(
            'a' => 'minify',
            'v' => $v
        ));
    }

    /**
     * Set the mirage mode.
     *
     * @param  bool  $v
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiMirage($v)
    {
        return $this->request(array(
            'a' => 'mirage2',
            'v' => (int)$v
        ));
    }

    /**
     * Add a new dns record.
     *
     * @param  array  $data
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiNewRecord(array $data)
    {
        $data['a'] = 'rec_new';
        return $this->request($data);
    }

    /**
     * Update an existing dns record.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiEditRecord($id, array $data)
    {
        $data['a'] = 'rec_edit';
        $data['id'] = $id;
        return $this->request($data);
    }

    /**
     * Delete an existing dns record.
     *
     * @param  int  $id
     * @return \GrahamCampbell\CoreAPI\Classes\APIResponse
     */
    public function apiDeleteRecord($id)
    {
        return $this->request(array(
            'a'  => 'rec_delete',
            'id' => $id
        ));
    }
}
