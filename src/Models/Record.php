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

namespace GrahamCampbell\CloudFlareAPI\Models;

use GrahamCampbell\CoreAPI\Models\AbstractModel;

/**
 * This is the zone model class.
 *
 * @package    Laravel-CloudFlare-API
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare-API
 */
class Record extends AbstractModel
{
    /**
     * The name.
     *
     * @var string
     */
    protected $name;

    /**
     * The zone object.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Models\Zone
     */
    protected $zone;

    /**
     * Create a new model instance.
     *
     * @param  \GuzzleHttp\Command\Guzzle\GuzzleClient  $client
     * @param  string  $name
     * @param  \GrahamCampbell\CloudFlareAPI\Models\Zone  $zone
     * @param  array  $cache
     * @return void
     */
    public function __construct(GuzzleClient $client, $name, Zone $zone, array $cache = array())
    {
        parent::__construct($client, $cache);

        $this->name = $name;
        $this->zone = $zone;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return (string) $this->name;
    }

    /**
     * Get the id.
     *
     * @return int
     */
    public function getId()
    {
        return (int) $this->lookup('rec_id');
    }

    /**
     * Lookup information.
     *
     * @param  string  $key
     * @return mixed
     */
    protected function lookup($key)
    {
        $data = array('z' => $this->zone->getZone());
        $data = $this->data($data);

        if (!$this->cache['recLoad']) {
            $records = $this->client->recLoadAll($data)->toArray()['response']['recs']['objs'];
            foreach($records as $record) {
                if ($record['name'] == $this->name) {
                    $this->cache['recLoad'] = $record;
                    break;
                }
            }
        }

        return $this->cache['recLoad'][$key];
    }

    /**
     * Clear the request cache.
     *
     * This method overrides the method in the parent class.
     *
     * @param  array|string  $methods
     * @return self
     */
    public function clearCache($methods = null)
    {
        if ($methods === null || $methods === 'all') {
            $this->cache = array();
        } else {
            foreach ((array) $methods as $method) {
                $this->cache[$method] = array();
                // we may need to clear out the record cache in the zone model
                // to avoid unintuitive behaviour
                if ($method == 'recLoad') {
                    $this->zone->clearRecordCache();
                }
            }
        }

        return $this;
    }

    /**
     * Get the zone instance.
     *
     * @return \GrahamCampbell\CloudFlareAPI\Models\Zone
     */
    public function getZone()
    {
        return $this->zone;
    }
}
