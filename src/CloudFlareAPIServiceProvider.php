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

namespace GrahamCampbell\CloudFlareAPI;

use Illuminate\Support\ServiceProvider;

/**
 * This is the cloudflare api service provider class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
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
        $this->registerCloudFlareAPIManager();
    }

    /**
     * Register the cloudflare api manager class.
     *
     * @return void
     */
    protected function registerCloudFlareAPIManager()
    {
        $this->app->bindShared('cloudflareapi', function ($app) {
            $config = $app['config'];
            $client = new Clients\ConnectionFactory();
            $factory = new CloudFlare\ConnectionFactory($client);

            return new Managers\CloudFlareAPIManager($config, $factory);
        });

        $this->app->alias('cloudflareapi', 'GrahamCampbell\CloudFlareAPI\Managers\CloudFlareAPIManager');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'cloudflareapi'
        );
    }
}
