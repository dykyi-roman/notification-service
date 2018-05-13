<?php

namespace Dykyi\ValueObject;

use InvalidArgumentException;

/**
 * Class PhoneNumber
 * @package Dykyi\ValueObject
 */
final class PhoneNumber implements ContactInformationInterface
{
    private $phone;

    /**
     * PhoneNumber constructor.
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public function __construct(string $value)
    {
        if(!preg_match('/^\(?\+?([0-9]{1,4})\)?[-\. ]?(\d{3})[-\. ]?([0-9]{7})$/', trim($value))) {
            throw new InvalidArgumentException(sprintf('"%s" is not a valid email', $value));
        }

        $this->phone = $value;
    }

    public function __toString()
    {
        return $this->phone;
    }

    public function equals(PhoneNumber $phone): bool
    {
        return strtolower((string)$this) === strtolower((string)$phone);
    }
}