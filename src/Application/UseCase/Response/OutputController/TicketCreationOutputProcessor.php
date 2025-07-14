<?php

declare(strict_types=1);

namespace App\Application\UseCase\Response\OutputController;

use App\Application\UseCase\Response\TicketCreationResponse;

/** @implements OutputProcessorInterface<TicketCreationResponse> */
class TicketCreationOutputProcessor implements OutputProcessorInterface
{
    public function processResponse(object $useCaseResponse): array
    {
        return [
            'title' => $useCaseResponse->ticket->getTitle(),
            'description' => $useCaseResponse->ticket->getDescription(),
            'priority' => $useCaseResponse->ticket->getPriority()->value,
            'creationDate' => $useCaseResponse->ticket->getCreatedAt()->format(\DateTimeInterface::ATOM),
            'updatingDate' => $useCaseResponse->ticket->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
        ];
    }
}
