<?php namespace GrahamCampbell\CloudFlareAPI\Classes;

/**
 * This file is part of Laravel Core API by Graham Campbell.
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
 * @package    Laravel-Core-API
 * @author     Graham Campbell
 * @license    Apache License
 * @copyright  Copyright 2013 Graham Campbell
 * @link       https://github.com/GrahamCampbell/Laravel-Core-API
 */

use Illuminate\Support\Facades\Config;

use GrahamCampbell\CoreAPI\Classes\CoreAPI;

class CloudFlareAPI extends CoreAPI {

    protected $coreapi;
    protected $token;
    protected $email;
    protected $domain;

    public function __construct() {
        $this->token = Config::get('cloudflare-api::token');
        $this->email = Config::get('cloudflare-api::email');
        $this->domain = Config::get('cloudflare-api::domain');

        $this->setup(Config::get('cloudflare-api::baseurl'));
    }

    public function resetBaseUrl() {
        $this->setBaseUrl(Config::get('cloudflare-api::baseurl'));
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($value) {
        $this->token = $value;
    }

    public function resetToken() {
        $this->token = Config::get('cloudflare-api::token');
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function resetEmail() {
        $this->email = Config::get('cloudflare-api::email');
    }

    public function getDomain() {
        return $this->domain;
    }

    public function setDomain($value) {
        $this->domain = $value;
    }

    public function resetDomain() {
        $this->domain = Config::get('cloudflare-api::domain');
    }

    protected function request($data, $z = true, $cache = false) {
        $data['tkn']   = $this->token;
        $data['email'] = $this->email;

        if ($z === true) {
            $data['z'] = $this->domain;
        }

        return $this->goPost($this->baseurl, null, $data, array(), $cache);
    }

    public function api_stats($interval = 20) {
        return $this->request(array(
            'a'        => 'stats',
            'interval' => $interval,
        ), true, 60);
    }

    public function api_zone_load_multi() {
        return $this->request(array(
            'a' => 'zone_load_multi',
        ), false, 5);
    }

    public function api_rec_load_all() {
        return $this->request(array(
            'a' => 'rec_load_all',
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
            'zones' => implode(',', $values),
        ), false, 5);
    }

    public function api_zone_ips($hours = 24, $class = 'r', $geo = false) {
        return $this->request(array(
            'a'     => 'zone_ips',
            'hours' => $hours,
            'class' => $class,
            'geo'   => (int)$geo,
        ), true, 5);
    }

    public function api_ip_lkup($ip) {
        return $this->request(array(
            'a'  => 'ip_lkup',
            'ip' => $ip,
        ), false, 5);
    }

    public function api_zone_settings() {
        return $this->request(array(
            'a' => 'zone_settings',
        ), true, 5);
    }
}
