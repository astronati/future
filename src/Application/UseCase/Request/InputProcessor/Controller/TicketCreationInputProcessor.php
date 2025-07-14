<?php

declare(strict_types=1);

namespace App\Application\UseCase\Request\InputProcessor\Controller;

use App\Application\UseCase\Request\TicketCreationRequest;
use App\Domain\Entity\Ticket\Priority;
use App\Domain\Entity\User\User;
use Symfony\Component\HttpFoundation\Request;

/** @implements InputProcessorInterface */
class TicketCreationInputProcessor implements InputProcessorInterface
{
    public function prepareRequest(Request $request, User $user): object
    {
        return new TicketCreationRequest(
            title: $request->request->getString('title'),
            description: $request->request->getString('description'),
            priority: $request->request->getEnum('priority', Priority::class),
        );
    }
}
