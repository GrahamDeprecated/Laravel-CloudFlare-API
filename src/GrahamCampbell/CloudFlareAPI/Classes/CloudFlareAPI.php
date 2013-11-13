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

class CloudFlareAPI extends CoreAPI {

    protected $token;
    protected $email;
    protected $domain;

    public function __construct($app) {
        parent::__construct($app);

        $this->token = $this->app['config']['cloudflare-api::token'];
        $this->email = $this->app['config']['cloudflare-api::email'];
        $this->domain = $this->app['config']['cloudflare-api::domain'];

        $this->setup($this->app['config']['cloudflare-api::baseurl']);
    }

    public function resetBaseUrl() {
        $this->setBaseUrl($this->app['config']['cloudflare-api::baseurl']);
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($value) {
        $this->token = $value;
    }

    public function resetToken() {
        $this->token = $this->app['config']['cloudflare-api::token'];
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function resetEmail() {
        $this->email = $this->app['config']['cloudflare-api::email'];
    }

    public function getDomain() {
        return $this->domain;
    }

    public function setDomain($value) {
        $this->domain = $value;
    }

    public function resetDomain() {
        $this->domain = $this->app['config']['cloudflare-api::domain'];
    }

    protected function request($data, $z = true, $cache = false) {
        $data['tkn']   = $this->token;
        $data['email'] = $this->email;

        if ($z === true) {
            $data['z'] = $this->domain;
        }

        $response = $this->post($this->baseurl, null, $data, array(), $cache);

        if (is_array($response->isDecodable())) {
            if ($response->decodeBody()['result'] !== 'success') {
                if ($response->decodeBody()['msg']) {
                    throw new CloudFlareException($response->getStatusCode(), null, $response->decodeBody()['msg'], $request->getHeaders()->toArray());
                }
            } else {
                return $response;
            }
        }

        throw new CloudFlareException($response->getStatusCode(), null, 'There was a json parse error.', $request->getHeaders()->toArray());
    }

    public function api_stats($interval = 20) {
        return $this->request(array(
            'a'        => 'stats',
            'interval' => $interval
        ), true, 60);
    }

    public function api_zone_load_multi() {
        return $this->request(array(
            'a' => 'zone_load_multi'
        ), false, 5);
    }

    public function api_rec_load_all() {
        return $this->request(array(
            'a' => 'rec_load_all'
        ), true, 5);
    }

    public function api_zone_check($zones) {
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

    public function api_zone_ips($hours = 24, $class = 'r', $geo = false) {
        return $this->request(array(
            'a'     => 'zone_ips',
            'hours' => $hours,
            'class' => $class,
            'geo'   => (int)$geo
        ), true, 5);
    }

    public function api_ip_lkup($ip) {
        return $this->request(array(
            'a'  => 'ip_lkup',
            'ip' => $ip
        ), false, 5);
    }

    public function api_zone_settings() {
        return $this->request(array(
            'a' => 'zone_settings'
        ), true, 5);
    }

    public function api_sec_lvl($v) {
        return $this->request(array(
            'a' => 'sec_lvl',
            'v' => $v
        ));
    }

    public function api_cache_lvl($v) {
        return $this->request(array(
            'a' => 'cache_lvl',
            'v' => $v
        ));
    }

    public function api_devmode($v) {
        return $this->request(array(
            'a' => 'zone_settings',
            'v' => (int)$v
        ));
    }

    public function api_fpurge_ts() {
        return $this->request(array(
            'a' => 'fpurge_ts',
            'v' => (int)true
        ));
    }

    public function api_zone_file_purge($url) {
        return $this->request(array(
            'a'   => 'zone_file_purge',
            'url' => $url
        ));
    }

    public function api_zone_grab($zid) {
        return $this->request(array(
            'a'   => 'zone_grab',
            'zid' => $zid
        ), false);
    }

    public function api_wl($key) {
        return $this->request(array(
            'a'   => 'wl',
            'key' => $key
        ), false);
    }

    public function api_ban($key) {
        return $this->request(array(
            'a'   => 'ban',
            'key' => $key
        ), false);
    }

    public function api_nul($key) {
        return $this->request(array(
            'a'   => 'nul',
            'key' => $key
        ), false);
    }

    public function api_ipv46($v) {
        return $this->request(array(
            'a' => 'ipv46',
            'v' => (int)$v
        ));
    }

    public function api_async($v) {
        return $this->request(array(
            'a' => 'async',
            'v' => $v
        ));
    }

    public function api_minify($v) {
        return $this->request(array(
            'a' => 'minify',
            'v' => $v
        ));
    }

    public function api_mirage2($v) {
        return $this->request(array(
            'a' => 'mirage2',
            'v' => (int)$v
        ));
    }

    public function api_rec_new(array $data) {
        $data['a'] = 'rec_new';
        return $this->request($data);
    }

    public function api_rec_edit(array $data) {
        $data['a'] = 'rec_edit';
        return $this->request($data);
    }

    public function api_rec_delete($id) {
        return $this->request(array(
            'a'  => 'rec_delete',
            'id' => $id
        ));
    }
}
