<?php

namespace Dykyi\Event;

use Dykyi\DTO\NotificationDTO;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AbstractSendEvent
 * @package Dykyi\Event
 */
abstract class AbstractSendEvent extends Event
{
    /** @var NotificationDTO */
    private $notification;

    /**
     * AbstractSendEvent constructor.
     * @param NotificationDTO $notification
     */
    public function __construct(NotificationDTO $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return NotificationDTO
     */
    public function getNotification(): NotificationDTO
    {
        return $this->notification;
    }


}