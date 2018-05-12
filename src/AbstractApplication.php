<?php

namespace Dykyi;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Dykyi\Listener\NotificationSubscriber;
use NunoMaduro\Collision\Provider;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\EventDispatcher\EventDispatcher;


/**
 * Class AbstractAplication
 * @package Dykyi
 */
abstract class AbstractApplication
{
    /** @var LoggerInterface null */
    private $logger;

    /** @var EntityManagerInterface */
    private $em;

    /** @var EventDispatcher  */
    private $dispatcher;

    /**
     * Application constructor.
     * @param bool $debug
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function __construct(bool $debug)
    {
        if ($debug === true) {
            (new Provider())->register();
        }
        $this->setDispatcher();
        $this->setLogger();
        $this->setEntityManager($debug);
    }

    /**
     * @param bool $isDevMode
     * @throws \Doctrine\ORM\ORMException
     */
    private function setEntityManager(bool $isDevMode): void
    {
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__], $isDevMode);
        $connectionParams = [
            'dbname' => getenv('bd.dbname'),
            'user' => getenv('db.user'),
            'password' => getenv('db.password'),
            'host' => getenv('db.host'),
            'driver' => 'pdo_mysql',
        ];
        $this->em = EntityManager::create($connectionParams, $config);
    }

    private function setDispatcher()
    {
        $this->dispatcher = new EventDispatcher();
        $this->dispatcher->addSubscriber(new NotificationSubscriber());
    }

    /**
     * @param LoggerInterface|null $logger
     */
    public function setLogger(LoggerInterface $logger = null): void
    {
        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     * @return EventDispatcher
     */
    public function getDispatcher(): EventDispatcher
    {
        return $this->dispatcher;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

}