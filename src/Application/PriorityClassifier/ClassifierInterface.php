<?php

declare(strict_types=1);

namespace App\Application\PriorityClassifier;

use App\Domain\Entity\Ticket\Priority;

/**
 * Interface for services that classify ticket priority.
 */
interface ClassifierInterface
{
    public function classify(string $title, string $description): Priority;
}
