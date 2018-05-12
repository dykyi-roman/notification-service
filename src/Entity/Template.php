<?php

namespace Dykyi\Entity;

/**
 * Class Template
 *
 * @Entity
 * @Table(name="template")
 */
class Template
{
    const EARLY = 0;
    const DUE = 1;
    const LATE = 2;

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
     * @Column(type="string")
     */
    private $text;

    /**
     * @param string $state
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public static function getIdByState(string $state)
    {
        $stateList = [
            'early' => self::EARLY,
            'due'   => self::DUE,
            'late'  => self::LATE,
        ];
        if (array_key_exists($state, $stateList)) {
            return $stateList[$state];
        }

        throw new \InvalidArgumentException(sprintf('Not found template %s', $state));
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

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}