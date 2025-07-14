<?php

declare(strict_types=1);

namespace App\Application\UseCase\Request;

use App\Domain\Entity\Ticket\Ticket;

readonly class TicketClassificationRequest
{
    public function __construct(
        public Ticket $ticket,
    ) {
    }
}
