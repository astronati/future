<?php

declare(strict_types=1);

namespace App\Infrastructure\OpenAI;

use OpenAI;
use OpenAI\Client;

final class OpenAIClientFactory
{
    public static function create(string $apiKey): Client
    {
        return OpenAI::client($apiKey);
    }
}
