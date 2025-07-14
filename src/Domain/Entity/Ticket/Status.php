<?php

declare(strict_types=1);

namespace App\Domain\Entity\Ticket;

enum Status: string
{
    case OPEN = 'OPEN';
    case IN_PROGRESS = 'IN_PROGRESS';
    case CLOSED = 'CLOSED';
}
