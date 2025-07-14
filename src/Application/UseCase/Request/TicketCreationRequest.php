<?php

declare(strict_types=1);

namespace App\Application\UseCase\Request;

use App\Domain\Entity\Ticket\Priority;
use App\Domain\Entity\User\User;

readonly class TicketCreationRequest
{
    public function __construct(
        public string $title,
        public string $description,
        public Priority $priority,
    ) {
    }
}
