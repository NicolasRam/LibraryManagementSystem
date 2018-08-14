<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 12/08/2018
 * Time: 12:58
 */

namespace App\Event\Subscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\Event;

class WorkflowLogger implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * WorkflowLogger constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Event $event
     */
    public function onLeave(Event $event)
    {
        $this->logger->alert(sprintf(
            'Blog post (id: "%s") performed transaction "%s" from "%s" to "%s"',
            $event->getSubject()->getId(),
            $event->getTransition()->getName(),
            implode(', ', array_keys($event->getMarking()->getPlaces())),
            implode(', ', $event->getTransition()->getTos())
        ));
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'workflow.blog_publishing.leave' => 'onLeave',
        );
    }
}
