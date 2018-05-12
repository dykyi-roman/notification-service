<?php

namespace Dykyi\Event;

use Dykyi\Entity\Template;
use Dykyi\Entity\Tenant;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AbstractSendEvent
 * @package Dykyi\Event
 */
abstract class AbstractSendEvent extends Event
{
    /** @var Tenant */
    private $tenant;

    /** @var Template  */
    private $template;

    /**
     * SendEmilEvent constructor.
     * @param Tenant $tenant
     * @param Template $template
     */
    public function __construct(Tenant $tenant, Template $template)
    {
        $this->tenant = $tenant;
        $this->template = $template;
    }

    /**
     * @return Tenant
     */
    public function getTenant(): Tenant
    {
        return $this->tenant;
    }

    /**
     * @return Template
     */
    public function getTemplate(): Template
    {
        return $this->template;
    }

}