<?php

declare(strict_types=1);

namespace App\Application\UseCase\Response;

use App\Domain\Entity\Ticket\Ticket;

readonly class TicketClassificationResponse
{
    public function __construct(
        public Ticket $ticket,
    ) {
    }
}
