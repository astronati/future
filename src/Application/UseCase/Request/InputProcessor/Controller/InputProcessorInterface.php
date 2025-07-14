<?php

declare(strict_types=1);

namespace App\Application\UseCase\Request\InputProcessor\Controller;

use App\Application\UseCase\UseCaseInterface;
use App\Domain\Entity\User\User;
use Symfony\Component\HttpFoundation\Request;

/**
 * @template TUseCaseRequest of object
 */
interface InputProcessorInterface
{
    /**
     * Creates a Use Case Request from the HTTP request and the authenticated user.
     *
     * This interface MUST be used for use cases that require an authenticated user.
     * The UserInterface instance will always be provided and MUST be used to build the input for the related Use Case.
     *
     * @param Request $request the raw HTTP request
     * @param User $user the currently authenticated user (never null)
     *
     * @return TUseCaseRequest a typed request object for the related Use Case
     *
     * @see UseCaseInterface for more details on Use Case execution and structure.
     */
    public function prepareRequest(Request $request, User $user): object;
}
