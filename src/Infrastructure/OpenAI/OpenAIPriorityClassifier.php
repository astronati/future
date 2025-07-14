<?php

declare(strict_types=1);

namespace App\Infrastructure\OpenAI;

use App\Application\PriorityClassifier\ClassifierInterface;
use App\Domain\Entity\Ticket\Priority;
use OpenAI\Client;

/**
 * AI priority classifier using OpenAI GPT-4 model.
 */
final class OpenAIPriorityClassifier implements ClassifierInterface
{
    public function __construct(
        private readonly Client $openAiClient,
    ) {}

    public function classify(string $title, string $description): Priority
    {
        try {
            $response = $this->openAiClient->chat()->create([
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an assistant that classifies IT support tickets by priority (low, medium, high). Reply with only the priority label.'
                    ],
                    [
                        'role' => 'user',
                        'content' => sprintf(
                            "Title: %s\nDescription: %s\nWhat is the priority?",
                            $title,
                            $description
                        ),
                    ],
                ],
                'temperature' => 0.2,
                'max_tokens' => 10,
            ]);

            $priority = strtolower(trim($response->choices[0]->message->content ?? ''));

            return $this->fromStringToPriority($priority);
        } catch (\Throwable $e) {
            // Don't do anything for the moment but returns default value. Maybe later we'll introduce a logger
        }

        return Priority::TBD;
    }

    private function fromStringToPriority(string $priority): Priority
    {
        return match ($priority) {
            'low' => Priority::LOW,
            'medium' => Priority::MEDIUM,
            'high' => Priority::HIGH,
            default => throw new \InvalidArgumentException("{$priority} is not a valid value")
        };
    }
}
