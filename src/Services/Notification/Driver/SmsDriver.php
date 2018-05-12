<?php

namespace Dykyi\Services\Notification\Driver;

use Dykyi\Entity\Template;

/**
 * Class SmsDriver
 * @package Dykyi\Services\Notification\Driver
 */
class SmsDriver implements DriverInterface
{
    /**
     * {@inheritdoc}
     */
    public function send(Template $template)
    {
        // TODO: Implement send() logic. Use AMQP protocol or Event+Subscriber for send
    }
}