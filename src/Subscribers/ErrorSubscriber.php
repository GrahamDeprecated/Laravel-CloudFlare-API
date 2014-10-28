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

namespace GrahamCampbell\CloudFlareAPI\Subscribers;

use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * This is the error subscriber class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare-API/blob/master/LICENSE.md> Apache 2.0
 */
class ErrorSubscriber implements SubscriberInterface
{
    /**
     * Get the subscriber events.
     *
     * @return array
     */
    public function getEvents()
    {
        return ['complete' => ['onComplete', RequestEvents::VERIFY_RESPONSE - 50]];
    }

    /**
     * Throw a RequestException if the response is not marked as successful.
     *
     * @param \GuzzleHttp\Event\CompleteEvent $event
     *
     * @throws \GuzzleHttp\Exception\RequestException
     *
     * @return void
     */
    public function onComplete(CompleteEvent $event)
    {
        $json = $event->getResponse()->json();

        if (array_get($json, 'result') !== 'success' || array_key_exists('response', $json) === false) {
            throw RequestException::create($event->getRequest(), $event->getResponse());
        }
    }
}
