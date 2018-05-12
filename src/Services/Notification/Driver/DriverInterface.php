<?php

namespace Dykyi\Services\Notification\Driver;

use Dykyi\Entity\Template;

/**
 * Interface DriverInterface
 * @package Dykyi\Services\Notification\Driver
 */
interface DriverInterface
{
    /**
     * @param Template $template
     * @return mixed
     */
    public function send(Template $template);
}