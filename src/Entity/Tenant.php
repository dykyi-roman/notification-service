<?php

namespace Dykyi\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Tenant
 *
 * @Entity(repositoryClass="Dykyi\Repository\TenantRepository")
 * @Table(name="tenant")
 */
class Tenant
{
    /**
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $fname;

    /**
     * @Column(type="string")
     */
    private $lname;

    /**
     * @Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @Column(type="datetime", name="updated_at")
     */
    private $updatedAt;

    /**
     * @Column(type="string", name="phone")
     */
    private $phone;

    /**
     * @Column(type="string", name="email")
     */
    private $email;

    /**
     * @OneToMany(targetEntity="Invoice", mappedBy="tenant")
     */
    private $invoice;

    /**
     * @OneToOne(targetEntity="TenantNotification", mappedBy="tenant")
     */
    private $config;

    public function getConfig(): TenantNotification
    {
        return $this->config;
    }

    public function __construct()
    {
        $this->invoice = new ArrayCollection();
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
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}