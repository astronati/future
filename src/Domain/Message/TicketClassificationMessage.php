<?php

declare(strict_types=1);

namespace App\Domain\Message;

use Symfony\Component\Uid\AbstractUid;

readonly class TicketClassificationMessage implements AsyncMessageInterface
{
    public function __construct(
        public AbstractUid $ticketId,
    ) {
    }
}
