<?php

namespace Dykyi\Event;

/**
 * Class SendSmsEvent
 * @package Dykyi\Event
 */
class SendSmsEvent extends AbstractSendEvent
{
    const NAME = 'cron.send.sms';
}