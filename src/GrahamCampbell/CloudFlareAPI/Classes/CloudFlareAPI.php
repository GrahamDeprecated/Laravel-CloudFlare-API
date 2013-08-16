<?php namespace GrahamCampbell\CloudFlareAPI\Classes;

use Illuminate\Support\Facades\Config;

use GrahamCampbell\CoreAPI\Facades\CoreAPI;

class CloudFlareAPI {

    protected $coreapi;
    protected $token;
    protected $email;
    protected $domain;
    protected $url;

    public function __construct() {
        $this->token = Config::get('cloudflare-api::token');
        $this->email = Config::get('cloudflare-api::email');
        $this->domain = Config::get('cloudflare-api::domain');
        $this->url = Config::get('cloudflare-api::url');

        CoreAPI::setup($this->url);
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

    public function getURL() {
        return $this->url;
    }

    public function setURL($value) {
        $this->url = $value;
    }

    public function resetURL() {
        $this->url = Config::get('cloudflare-api::url');
    }

    protected function request($data, $z = true) {
        $data['tkn']   = $this->token;
        $data['email'] = $this->email;

        if ($z === true) {
            $data['z'] = $this->domain;
        }

        return CoreAPI::goPost($this->url, null, $data);
    }

    public function api_stats($interval = 20) {
        return $this->request(array(
            'a'        => 'stats',
            'interval' => $interval,
        ));
    }

    public function api_zone_load_multi() {
        return $this->request(array(
            'a' => 'zone_load_multi',
        ), false);
    }

    public function api_rec_load_all() {
        return $this->request(array(
            'a' => 'rec_load_all',
        ));
    }

    public function api_zone_check($zones = array('*')) {
        return $this->request(array(
            'a'     => 'zone_check',
            'zones' => implode(',', $zones),
        ), false);
    }

    public function api_zone_ips($hours = 24, $class = 'r', $geo = false) {
        return $this->request(array(
            'a'     => 'zone_ips',
            'hours' => $hours,
            'class' => $class,
            'geo'   => (int)$geo,
        ));
    }

    public function api_ip_lkup($ip) {
        return $this->request(array(
            'a'  => 'ip_lkup',
            'ip' => $ip,
        ), false);
    }

    public function api_zone_settings() {
        return $this->request(array(
            'a' => 'zone_settings',
        ));
    }
}
