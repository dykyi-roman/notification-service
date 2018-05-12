<?php

namespace Dykyi\Entity;

/**
 * Class City
 *
 * @Entity
 * @Table(name="city")
 */
class City
{
    /**
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string", unique=TRUE)
     */
    private $name;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}