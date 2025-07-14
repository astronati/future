<?php

declare(strict_types=1);

namespace App\Domain\Repository\Ticket;

use App\Domain\Entity\Ticket\Ticket;
use App\Domain\Repository\RepositoryInterface;

/**
 * @extends RepositoryInterface<Ticket>
 */
interface TicketRepositoryInterface extends RepositoryInterface
{
}
