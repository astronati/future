<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\PriorityClassifier\ClassifierInterface;
use App\Application\UseCase\Request\TicketClassificationRequest;
use App\Application\UseCase\Response\TicketClassificationResponse;
use App\Domain\Repository\Ticket\TicketRepositoryInterface;

/** @implements UseCaseInterface<TicketClassificationRequest, TicketClassificationResponse> */
class TicketClassificationUseCase implements UseCaseInterface
{
    public function __construct(
        private ClassifierInterface $classifier,
        private TicketRepositoryInterface $ticketRepository,
    ) {
    }

    public function execute(object $useCaseRequest): object
    {
        $classifiedPriority = $this->classifier->classify($useCaseRequest->ticket->getTitle(), $useCaseRequest->ticket->getDescription());
        $useCaseRequest->ticket->setPriority($classifiedPriority);
        $this->ticketRepository->save($useCaseRequest->ticket, true);

        return new TicketClassificationResponse($useCaseRequest->ticket);
    }
}
