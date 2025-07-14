<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Ticket;

use App\Domain\Entity\Ticket\Ticket;
use App\Domain\Repository\Ticket\TicketRepositoryInterface;
use App\Infrastructure\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends EntityRepository<Ticket>
 */
class TicketRepository extends EntityRepository implements TicketRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }
}
