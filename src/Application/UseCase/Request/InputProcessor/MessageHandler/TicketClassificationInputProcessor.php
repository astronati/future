<?php

declare(strict_types=1);

namespace App\Application\UseCase\Request\InputProcessor\MessageHandler;

use App\Application\UseCase\Request\TicketClassificationRequest;
use App\Domain\Message\AsyncMessageInterface;
use App\Domain\Message\TicketClassificationMessage;
use App\Domain\Repository\Ticket\TicketRepositoryInterface;

/** @implements InputProcessorInterface<TicketClassificationMessage> */
class TicketClassificationInputProcessor implements InputProcessorInterface
{
    public function __construct(private TicketRepositoryInterface $ticketRepository)
    {}

    public function prepareRequest(AsyncMessageInterface $message): object
    {
        return new TicketClassificationRequest($this->ticketRepository->get($message->ticketId));
    }
}
