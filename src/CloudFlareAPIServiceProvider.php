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

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the cloudflare api service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CloudFlareAPIServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/cloudflareapi.php');

        $this->publishes([$source => config_path('cloudflareapi.php')]);

        $this->mergeConfigFrom($source, 'cloudflareapi');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('cloudflareapi.factory', function () {
            $client = new Factories\ClientFactory();

            return new Factories\CloudFlareAPIFactory($client);
        });

        $app->alias('cloudflareapi.factory', 'GrahamCampbell\CloudFlareAPI\Factories\CloudFlareAPIFactory');
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('cloudflareapi', function ($app) {
            $config = $app['config'];
            $factory = $app['cloudflareapi.factory'];

            return new CloudFlareAPIManager($config, $factory);
        });

        $app->alias('cloudflareapi', 'GrahamCampbell\CloudFlareAPI\CloudFlareAPIManager');
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
