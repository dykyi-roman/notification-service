<?php

namespace Dykyi\Services\Notification;

use Dykyi\DTO\NotificationDTO;
use Dykyi\Entity\Template;
use Dykyi\Entity\Tenant;
use Dykyi\Services\Exception\ServiceNotDetectedException;
use Dykyi\Services\Notification\Driver\DriverInterface;

/**
 * Class NotificationService
 * @package Dykyi\Services\Notification
 */
class NotificationService
{
    private $drivers = [];

    public function __construct($drivers)
    {
        if ($drivers instanceof DriverInterface) {
            $this->drivers[] = $drivers;
        }
        if (is_array($drivers) && count($drivers) > 0) {
            $this->drivers = $drivers;
        }

        if (null === $this->drivers) {
            throw new ServiceNotDetectedException('Can`t detected a notification service');
        }
    }

    /**
     * @param NotificationDTO $notification
     */
    public function execute(NotificationDTO $notification): void
    {
        foreach ($this->getDrivers() as $driver) {
            //TODO:: prepare for send
            $driver->send($notification);
        }
    }

    public function getDrivers(): array
    {
        return $this->drivers;
    }

}