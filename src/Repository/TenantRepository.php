<?php

namespace Dykyi\Repository;

use Doctrine\ORM\EntityRepository;
use Dykyi\Entity\Invoice;
use Dykyi\Entity\TenantNotification;

/**
 * Class CityRepository
 * @package Dykyi\Repository\
 */
class TenantRepository extends EntityRepository
{
    /**
     * @param string $date
     * @param int $template
     * @return mixed
     */
    private function getTenantByEndDate(string $date, int $template)
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->innerJoin(Invoice::class, 'i', 'WITH', 'i.tenant = t.id')
            ->innerJoin(TenantNotification::class, 'c', 'WITH', 'c.tenant = t.id')
            ->where('i.status = :status and c.template = :template and i.endDate = ' . $date)
            ->groupBy('t.id')
            ->addGroupBy('t.lname')
            ->setParameters(['status' => 1,'template' => $template])
            ->getQuery()
            ->execute();
    }

    /**
     * @return array
     */
    public function getTenantForSendNotification(): array
    {
        try {
            return [
                'early'=> $this->getTenantByEndDate(sprintf("DATE_SUB(CURRENT_DATE(), %s, 'day')", getenv('app.date.early.remind')),TenantNotification::TEMPLATE_EARLY),
                'due'  => $this->getTenantByEndDate('current_date()', TenantNotification::TEMPLATE_DUE),
                'late' => $this->getTenantByEndDate(sprintf("DATE_ADD(CURRENT_DATE(), %s, 'day')", getenv('app.date.late.remind')),TenantNotification::TEMPLATE_LATE
                ),
            ];
        } catch (\Exception $exception) {
            // dump($exception);
        }
    }
}