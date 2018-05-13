<?php

namespace Dykyi\ValueObject;

use InvalidArgumentException;

/**
 * Class EmailAddress
 * @package Dykyi\ValueObject
 */
class EmailAddress implements ContactInformationInterface
{
    private $address;

    /**
     * EmailAddress constructor.
     * @param $value
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('"%s" is not a valid email', $value));
        }

        $this->address = $value;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->address;
    }

    public function equals(EmailAddress $address): bool
    {
        return strtolower((string)$this) === strtolower((string)$address);
    }
}