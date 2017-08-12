<?php

namespace App\Infrastructure\Doctrine\Event;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Illuminate\Contracts\Events\Dispatcher;
use App\Domain\Common\AggregateRoot;

class DoctrineEntityEventSubscriber implements EventSubscriber
{

    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    public function __construct(Dispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::onFlush];
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $uow = $args->getEntityManager()->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            $this->flushEntityEvents($entity);
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            $this->flushEntityEvents($entity);
        }

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            $this->flushEntityEvents($entity);
        }

    }

    private function flushEntityEvents($entity)
    {
        if ($entity instanceof AggregateRoot) {

            foreach ($entity->releaseEvents() as $event) {
                $this->eventDispatcher->fire($event);
            }
        }
    }
}