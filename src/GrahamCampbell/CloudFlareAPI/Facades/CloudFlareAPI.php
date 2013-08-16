<?php namespace GrahamCampbell\CloudFlareAPI\Facades;

use Illuminate\Support\Facades\Facade;

class CloudFlareAPI extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'cloudflareapi'; }

}
