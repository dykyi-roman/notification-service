<?php

namespace Dykyi\Entity;

/**
 * Class TenantNotification
 *
 * @Entity
 * @Table(name="tenant_notification")
 */
class TenantNotification
{
    const TYPE_SMS  = 'sms';
    const TYPE_EMIL = 'emil';

    const TEMPLATE_EARLY = 0;
    const TEMPLATE_DUE   = 1;
    const TEMPLATE_LATE  = 2;

    /**
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $type;

    /**
     * @Column(type="string")
     */
    private $template;

    /**
     * @OneToOne(targetEntity="Tenant")
     *
     */
    private $tenant;

    public function getTenant(): Tenant
    {
        return $this->tenant;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return json_decode($this->type);
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = json_encode($type);
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return json_decode($this->template);
    }

    public function isNeedSmsSend():bool
    {
        return (bool)$this->getType()->sms;
    }

    public function isNeedEmailSend():bool
    {
        return (bool)$this->getType()->email;
    }

    public function isDueTemplate():bool
    {
        return $this->getTemplate() === self::TEMPLATE_DUE;
    }

    public function isLateTemplate():bool
    {
        return $this->getTemplate() === self::TEMPLATE_LATE;
    }

    public function isEarlyTemplate():bool
    {
        return $this->getTemplate() === self::TEMPLATE_EARLY;
    }
}