<?php

declare(strict_types=1);

namespace App\Domain\Entity\Ticket;

enum Priority: string
{
    case LOW = 'LOW';
    case MEDIUM = 'MEDIUM';
    case HIGH = 'HIGH';
    case TBD = 'TBD';
}
