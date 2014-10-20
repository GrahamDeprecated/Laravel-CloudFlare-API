<?php

/**
 * This file is part of Laravel CloudFlare API by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\CloudFlareAPI;

use GrahamCampbell\CloudFlareAPI\Exceptions\ProviderResolutionException;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

/**
 * This is the abstract api class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
abstract class AbstractAPI
{
    /**
     * The provider cache.
     *
     * @var array
     */
    protected $providers = array();

    /**
     * The guzzle client class.
     *
     * @var \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    protected $client;

    /**
     * Create a new core api instance.
     *
     * @param \GuzzleHttp\Command\Guzzle\GuzzleClient $client
     *
     * @return void
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get the provider namespace.
     *
     * @return string
     */
    abstract protected function getProviderNamespace();

    /**
     * Get a provider object.
     *
     * @param string $name
     *
     * @return \GrahamCampbell\CloudFlareAPI\Providers\AbstractProvider
     */
    protected function getProvider($name)
    {
        if (!array_key_exists($name, $this->providers)) {
            $this->providers[$name] = $this->getNewProvider($name);
        }

        return $this->providers[$name];
    }

    /**
     * Get a new provider object.
     *
     * @param string $name
     *
     * @return \GrahamCampbell\CloudFlareAPI\Providers\AbstractProvider
     */
    protected function getNewProvider($name)
    {
        $class = $this->getProviderClass($name);

        return new $class($this->client);
    }

    /**
     * Get a provider class name.
     *
     * @param string $name
     *
     * @throws \GrahamCampbell\CloudFlareAPI\Exceptions\ProviderResolutionException
     *
     * @return string
     */
    protected function getProviderClass($name)
    {
        $class = $this->getProviderNamespace().'\\'.ucfirst($name).'Provider';

        if (class_exists($class)) {
            return $class;
        }

        throw new ProviderResolutionException($class, $name);
    }

    /**
     * Get the provider method name.
     *
     * Here we calculate the correct method to call on the provider. Note that
     * this won't work if the singular form is the same as the plural. For this
     * reason, provider classes should be named in away that avoids using such
     * words, otherwise we have no way for the user to specify whether they
     * want a single model, or a collection unless we were to change the syntax
     * of the whole process which is undesirable.
     *
     * @param bool $singular
     * @param bool $where
     * @param bool $create
     *
     * @throws \GrahamCampbell\CloudFlareAPI\Exceptions\ProviderResolutionException
     *
     * @return string
     */
    protected function getProviderMethod($singular, $where, $create)
    {
        if ($singular && !$where && !$create) {
            return 'get';
        }

        if (!$singular && !$where && !$create) {
            return 'all';
        }

        if (!$singular && $where && !$create) {
            return 'where';
        }

        if ($singular && !$where && $create) {
            return 'create';
        }

        throw new ProviderResolutionException("The provider method could not be resolved.");
    }

    /**
     * Get the normalised method data.
     *
     * See the node about naming on the getProviderMethod method.
     *
     * @param string $method
     *
     * @return array
     */
    protected function normaliseMethod($method)
    {
        // strip the where from the end
        if ($where = (strpos($method, 'Where') !== false)) {
            $method = substr($method, 0, -5);
        }

        // strip the create from the start
        if ($create = (strpos($method, 'create') !== false)) {
            $method = lcfirst(substr($method, 6));
        }

        // calculate singular information
        $isSingular = (($singular = str_singular($method)) == $method);

        return compact('where', 'create', 'singular', 'isSingular');
    }

    /**
     * Get the client instance.
     *
     * @return \GuzzleHttp\Command\Guzzle\GuzzleClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Dynamically pass information between the providers.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @throws \GrahamCampbell\CloudFlareAPI\Exceptions\ProviderResolutionException
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $data = $this->normaliseMethod($method);

        $function = $this->getProviderMethod($data['isSingular'], $data['where'], $data['create']);

        $provider = $this->getProvider($data['singular']);

        if (!method_exists($provider, $function)) {
            throw new ProviderResolutionException("The provider does not support '$function' functionality.");
        }

        return call_user_func_array(array($provider, $function), $parameters);
    }
}
