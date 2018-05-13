<?php

namespace Dykyi\DTO;

use Dykyi\ValueObject\ContactInformationInterface;

/**
 * Class NotificationDTO
 * @package Dykyi\DTO
 */
class NotificationDTO
{

    /** @var ContactInformationInterface  */
    private $contactInformation;

    private $template;

    /**
     * NotificationDTO constructor.
     * @param ContactInformationInterface $contactInformation
     * @param $template
     */
    public function __construct(ContactInformationInterface $contactInformation, string $template)
    {
        $this->contactInformation = $contactInformation;
        $this->template = $template;
    }

    /**
     * @return ContactInformationInterface
     */
    public function getContactInformation(): ContactInformationInterface
    {
        return $this->contactInformation;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }
}