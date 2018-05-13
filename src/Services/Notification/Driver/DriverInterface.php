<?php

namespace Dykyi\Services\Notification\Driver;

/**
 * Interface DriverInterface
 * @package Dykyi\Services\Notification\Driver
 */
interface DriverInterface
{
    /**
     * @param $notification
     * @return mixed
     */
    public function send($notification);
}