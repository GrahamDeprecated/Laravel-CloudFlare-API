<?php namespace GrahamCampbell\CloudFlareAPI;

use Illuminate\Support\ServiceProvider;

class CloudFlareAPIServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('graham-campbell/cloudflare-api');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['cloudflareapi'] = $this->app->share(function($app) {
            return new Classes\CloudFlareAPI;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('cloudflareapi');
    }
}
