<?php

declare(strict_types=1);

namespace App\Domain\Message;

/**
 * Marker interface for asynchronous messages dispatched within the domain layer.
 *
 * Implement this interface to indicate that the message should be handled asynchronously by the message bus, and that
 * it originates from the domain context rather than the application layer.
 */
interface AsyncMessageInterface
{
}
