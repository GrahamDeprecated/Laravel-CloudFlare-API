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

    public function getEmail() {
        return $this->email;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function getURL() {
        return $this->url;
    }

    protected function request($data) {
        $data['tkn']   = $this->token;
        $data['email'] = $this->email;
        $data['z']     = $this->domain;

        return CoreAPI::goPost($this->url, null, $data);
    }

    public function api_stats($interval = 20) {
        return $this->request(array(
            'a'        => 'stats',
            'interval' => $interval,
        ));
    }
}
