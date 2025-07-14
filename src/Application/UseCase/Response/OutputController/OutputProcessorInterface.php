<?php

declare(strict_types=1);

namespace App\Application\UseCase\Response\OutputController;

use App\Application\UseCase\UseCaseInterface;

/**
 * @template T of object
 */
interface OutputProcessorInterface
{
    /**
     *
     * @see UseCaseInterface for any detail about Use Case and Response.
     * Any OutputProcessor MUST process a Use Case Response.
     * When a Use Case is "called" within a Controller then its relative OutputProcessor MUST implement this interface.
     * Any OutputProcessor implementing this interface MUST return an array from the given Use Case Response that is the
     * parameter argument of the 'render' method of the controller action.
     *
     * @param T $useCaseResponse A typed response object for the related Use Case
     * @return array<string, mixed>
     */
    public function processResponse(object $useCaseResponse): array;
}
