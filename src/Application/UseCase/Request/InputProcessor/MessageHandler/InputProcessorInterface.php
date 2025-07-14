<?php

declare(strict_types=1);

namespace App\Application\UseCase\Request\InputProcessor\MessageHandler;

use App\Application\UseCase\UseCaseInterface;
use App\Domain\Message\AsyncMessageInterface;

/**
 * @template T of object
 */
interface InputProcessorInterface
{
    /**
     * Creates a Use Case Request from the actions performed by messenger.
     *
     * @param T $message
     *
     * @see UseCaseInterface for more details on Use Case execution and structure.
     */
    public function prepareRequest(AsyncMessageInterface $message): object;
}
