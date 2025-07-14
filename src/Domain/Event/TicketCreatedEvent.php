<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\Entity\Ticket\Ticket;
use Symfony\Contracts\EventDispatcher\Event;

class TicketCreatedEvent extends Event
{
    public function __construct(
        public readonly Ticket $ticket,
    ) {
    }
}
