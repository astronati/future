<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase;

use App\Application\UseCase\Request\TicketCreationRequest;
use App\Application\UseCase\TicketCreationUseCase;
use App\Domain\Entity\Ticket\Priority;
use App\Domain\Entity\Ticket\Ticket;
use App\Domain\Event\TicketCreatedEvent;
use App\Domain\Repository\Ticket\TicketRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TicketCreationUseCaseTest extends TestCase
{
    use ProphecyTrait;

    /** @var ObjectProphecy<EventDispatcherInterface> */
    private $eventDispatcher;

    /** @var ObjectProphecy<TicketRepositoryInterface> */
    private $ticketRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketRepository = $this->prophesize(TicketRepositoryInterface::class);
        $this->eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
    }

    public function testCanBeExecuted(): void
    {
        $title = 'Example Ticket';
        $description = 'This is a test ticket';
        $priority = Priority::HIGH;
        $request = new TicketCreationRequest(
            title: $title,
            description: $description,
            priority: $priority
        );

        $this->ticketRepository->save(
            Argument::that(fn (Ticket $ticket): bool => $ticket->getTitle() === $title),
            true
        )->shouldBeCalled();

        $this->eventDispatcher->dispatch(
            Argument::that(fn (TicketCreatedEvent $event): bool => $event->ticket->getTitle() === $title)
        )->shouldBeCalled();


        $sut = new TicketCreationUseCase(
            ticketRepository: $this->ticketRepository->reveal(),
            eventDispatcher: $this->eventDispatcher->reveal()
        );
        $response = $sut->execute($request);

        $this->assertSame($title, $response->ticket->getTitle());
        $this->assertSame($description, $response->ticket->getDescription());
        $this->assertSame($priority, $response->ticket->getPriority());
    }
}
