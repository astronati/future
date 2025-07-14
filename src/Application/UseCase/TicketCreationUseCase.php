<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\UseCase\Request\TicketCreationRequest;
use App\Application\UseCase\Response\TicketCreationResponse;
use App\Domain\Entity\Ticket\Ticket;
use App\Domain\Event\TicketCreatedEvent;
use App\Domain\Repository\Ticket\TicketRepositoryInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/** @implements UseCaseInterface<TicketCreationRequest, TicketCreationResponse> */
class TicketCreationUseCase implements UseCaseInterface
{
    public function __construct(
        private TicketRepositoryInterface $ticketRepository,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function execute(object $useCaseRequest): object
    {
        $ticket = new Ticket(
            title: $useCaseRequest->title,
            description: $useCaseRequest->description,
            priority: $useCaseRequest->priority
        );
        $this->ticketRepository->save($ticket, true);

        $event = new TicketCreatedEvent($ticket);
        $this->eventDispatcher->dispatch($event);

        return new TicketCreationResponse($ticket);
    }
}
