<?php

namespace Dykyi;

use Dykyi\DTO\NotificationDTO;
use Dykyi\Entity\Template;
use Dykyi\Entity\Tenant;
use Dykyi\Event\SendEmilEvent;
use Dykyi\Event\SendSmsEvent;
use Dykyi\ValueObject\EmailAddress;
use Dykyi\ValueObject\PhoneNumber;

/**
 * Class Application
 * @package Dykyi
 */
class Application extends AbstractApplication
{
    /**
     * @param Tenant $tenant
     * @param Template $template
     * @throws \InvalidArgumentException
     */
    private function sendEmailToTenant(Tenant $tenant, Template $template): void
    {
        if ($tenant->getConfig()->isNeedEmailSend()) {
            $notification = new NotificationDTO(new EmailAddress($tenant->getEmail()), $template->getText());
            $event = new SendEmilEvent($notification);
            $this->getDispatcher()->dispatch(SendEmilEvent::NAME, $event);
        }
    }

    /**
     * @param Tenant $tenant
     * @param Template $template
     * @throws \InvalidArgumentException
     */
    private function sendSmsToTenant(Tenant $tenant, Template $template): void
    {
        if ($tenant->getConfig()->isNeedSmsSend()) {
            $notification = new NotificationDTO(new PhoneNumber($tenant->getPhone()), $template->getText());
            $event = new SendSmsEvent($notification);
            $this->getDispatcher()->dispatch(SendSmsEvent::NAME, $event);
        }
    }

    public function sendNotification(): void
    {
        try {
            /** @var Template[] $templates */
            $templates = $this->getEntityManager()->getRepository(Template::class)->findAll();

            $this->getEntityManager()->getRepository(Tenant::class)->find(1);
            $prepareList = $this->getEntityManager()->getRepository(Tenant::class)->getTenantForSendNotification();

            /**
             * @var string $state
             * @var Tenant[] $tenants
             */
            foreach ($prepareList as $state => $tenants) {
                foreach ($tenants as $tenant) {
                    $this->sendSmsToTenant($tenant,  $templates[Template::getIdByState($state)]);
                    $this->sendEmailToTenant($tenant,$templates[Template::getIdByState($state)]);
                }
            }
        } catch (\Exception $e) {
            $this->getLogger()->error($e->getMessage(), $e->getCode());
        }
    }
}