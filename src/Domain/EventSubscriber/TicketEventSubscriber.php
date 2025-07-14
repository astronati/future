<?php

declare(strict_types=1);

namespace App\Domain\EventSubscriber;

use App\Domain\Event\TicketCreatedEvent;
use App\Domain\Message\TicketClassificationMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TicketEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MessageBusInterface $messageBus,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            TicketCreatedEvent::class => 'classifyPriority',
        ];
    }

    public function classifyPriority(TicketCreatedEvent $event): void
    {
        $this->messageBus->dispatch(new TicketClassificationMessage($event->ticket->getId()));
    }
}
