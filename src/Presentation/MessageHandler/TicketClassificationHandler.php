<?php

declare(strict_types=1);

namespace App\Presentation\MessageHandler;

use App\Application\UseCase\Request\InputProcessor\MessageHandler\TicketClassificationInputProcessor;
use App\Application\UseCase\TicketClassificationUseCase;
use App\Domain\Message\TicketClassificationMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class TicketClassificationHandler
{
    public function __construct(
        private TicketClassificationInputProcessor $inputProcessor,
        private TicketClassificationUseCase $useCase,
    ) {
    }

    public function __invoke(TicketClassificationMessage $message): void
    {
        $this->useCase->execute(
            $this->inputProcessor->prepareRequest($message)
        );
    }
}
