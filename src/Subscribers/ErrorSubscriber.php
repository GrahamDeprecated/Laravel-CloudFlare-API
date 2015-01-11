<?php

/*
 * This file is part of Laravel CloudFlare API.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlareAPI\Subscribers;

use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * This is the error subscriber class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
