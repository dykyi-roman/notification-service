<?php

namespace Dykyi\Listener;

use Dykyi\Event\SendEmilEvent;
use Dykyi\Event\SendSmsEvent;
use Dykyi\Services\Notification\Driver\EmailDriver;
use Dykyi\Services\Notification\Driver\SmsDriver;
use Dykyi\Services\Notification\NotificationService;
use Dykyi\Services\Exception\ServiceNotDetectedException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class NotificationSubscriber
 * @package Dykyi\Lisener
 */
class NotificationSubscriber implements EventSubscriberInterface
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            SendEmilEvent::NAME => 'onEmailSend',
            SendSmsEvent::NAME  => 'onSmsSend',
        ];
    }

    /**
     * @param SendEmilEvent $event
     * @throws ServiceNotDetectedException
     */
    public function onEmailSend(SendEmilEvent $event)
    {
        //TODO:: You can use here AMQP protocol for send
        $notification = new NotificationService(new EmailDriver());
        $notification->execute($event->getNotification());
    }


    /**
     * @param SendSmsEvent $event
     * @throws ServiceNotDetectedException
     */
    public function onSmsSend(SendSmsEvent $event)
    {
        //TODO:: You can use here AMQP protocol for send
        $notification = new NotificationService(new SmsDriver());
        $notification->execute($event->getNotification());
    }

}