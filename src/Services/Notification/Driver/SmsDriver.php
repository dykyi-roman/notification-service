<?php

namespace Dykyi\Services\Notification\Driver;

/**
 * Class SmsDriver
 * @package Dykyi\Services\Notification\Driver
 */
class SmsDriver implements DriverInterface
{
    /**
     * {@inheritdoc}
     */
    public function send($notification)
    {
        // TODO: Implement send() logic. Use AMQP protocol or Event+Subscriber for send
    }
}