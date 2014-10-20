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

namespace GrahamCampbell\CloudFlareAPI\Exceptions;

use Exception;

/**
 * This is the provider resolution exception class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
class ProviderResolutionException extends Exception
{
    /**
     * The class name.
     *
     * @var string
     */
    protected $class;

    /**
     * The provider name.
     *
     * @var string
     */
    protected $name;

    /**
     * Create a new provider resolution exception instance.
     *
     * @param string $class
     * @param string $name
     *
     * @return void
     */
    public function __construct($class, $name)
    {
        $this->class = $class;
        $this->name = $name;

        parent::__construct("Class '$class' not found for the '$name' provider.");
    }

    /**
     * Get the class name.
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->class;
    }

    /**
     * Get the provider name.
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->name;
    }
}
