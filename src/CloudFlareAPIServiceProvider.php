<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlareAPI;

use Illuminate\Support\ServiceProvider;

/**
 * This is the cloudflare api service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CloudFlareAPIServiceProvider extends ServiceProvider
{
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
    public function boot()
    {
        $this->package('graham-campbell/cloudflare-api', 'graham-campbell/cloudflare-api', __DIR__);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->bindShared('cloudflareapi.factory', function () {
            $client = new Factories\ClientFactory();

            return new Factories\CloudFlareAPIFactory($client);
        });

        $this->app->alias('cloudflareapi.factory', 'GrahamCampbell\CloudFlareAPI\Factories\CloudFlareAPIFactory');
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->bindShared('cloudflareapi', function ($app) {
            $config = $app['config'];
            $factory = $app['cloudflareapi.factory'];

            return new CloudFlareAPIManager($config, $factory);
        });

        $this->app->alias('cloudflareapi', 'GrahamCampbell\CloudFlareAPI\CloudFlareAPIManager');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'cloudflareapi',
            'cloudflareapi.factory',
        ];
    }
}
