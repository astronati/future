<?php

declare(strict_types=1);

namespace App\Presentation\Controller\App;

use App\Application\UseCase\Request\InputProcessor\Controller\TicketCreationInputProcessor;
use App\Application\UseCase\Response\OutputController\TicketCreationOutputProcessor;
use App\Application\UseCase\TicketCreationUseCase;
use App\Domain\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TicketCreationController extends AbstractController
{
    public function __construct(
        private TicketCreationUseCase $useCase,
        private TicketCreationInputProcessor $inputProcessor,
        private TicketCreationOutputProcessor $outputProcessor,
    ) {
    }

    #[Route('/tickets', name: 'ticket_creation', methods: [Request::METHOD_POST])]
    public function creat(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $output = $this->outputProcessor->processResponse(
            $this->useCase->execute(
                $this->inputProcessor->prepareRequest($request, $user),
            )
        );

        return $this->json($output, Response::HTTP_CREATED);
    }
}
