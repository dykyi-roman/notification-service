<?php

namespace Dykyi\Entity;

/**
 * Class Invoice
 *
 * @Entity
 * @Table(name="invoice")
 */
class Invoice
{
    /**
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     * @Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Tenant", inversedBy="tenant")
     */
    private $tenant;

    /**
     * @Column(type="integer")
     */
    private $lease_id;

    /**
     * @Column(type="datetime", name="start_date")
     */
    private $startDate;

    /**
     * @Column(type="datetime", name="end_date")
     */
    private $endDate;

    /**
     * @Column(type="integer")
     */
    private $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTenant(): Tenant
    {
        return $this->tenant;
    }

    /**
     * @param mixed $tenant_id
     */
    public function setTenantId($tenant_id)
    {
        $this->tenant_id = $tenant_id;
    }

    /**
     * @return mixed
     */
    public function getLeaseId()
    {
        return $this->lease_id;
    }

    /**
     * @param mixed $lease_id
     */
    public function setLeaseId($lease_id)
    {
        $this->lease_id = $lease_id;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


}