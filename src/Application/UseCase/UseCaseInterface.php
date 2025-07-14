<?php

declare(strict_types=1);

namespace App\Application\UseCase;

/**
 * @template TUseCaseRequest of object
 * @template TUseCaseResponse of object
 */
interface UseCaseInterface
{
    /**
     * Any action that a user is able to perform is called Use Case.
     * RECOMMENDED Every Use Case is a specific scenario in which a user can use an application.
     * Use Cases are often described with a simple sentence, such as "List all products" or "As a customer, I want to be
     * able to add a product to the shopping cart".
     *
     * Each of any Use Case needs certain input from the user.
     * For example, you cannot list products in category if you don't know which category is of interest to the user.
     * The data structure that contains all information required by the Use Case is called Use Case Request.
     * A Use Case Request MUST be a simple data structure.
     *
     * Whatever the result of Use Case execution is, it MUST be returned as a Use Case Response.
     * In case of successful execution, the Response SHOULD contain all the information that we display to the user.
     * For example, the Response of "List products in category" Use Case contains all the products in desired category,
     * or a chosen number of them if the result is too big to be displayed on one page.
     * Alternatively, if something goes wrong, the Response SHOULD contain the information that will be used to identify
     * the failure, such as an error message and code.
     * Similarly to a Request object, the Use Case Response MUST be a data structure that contains all the data that
     * will be presented to the user.
     *
     * @param TUseCaseRequest $useCaseRequest
     *
     * @return TUseCaseResponse
     */
    public function execute(object $useCaseRequest): object;
}
