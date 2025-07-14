<?php

declare(strict_types=1);

namespace App\Domain\Entity\Ticket;

use App\Domain\Entity\LifecycleDates;
use App\Infrastructure\Repository\Ticket\TicketRepository;
use Cake\Chronos\Chronos;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    use LifecycleDates;

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private AbstractUid $id;

    #[ORM\Column(type: Types::TEXT)]
    private string $title;

    #[ORM\Column(type: Types::STRING)]
    private string $description;

    #[ORM\Column(type: Types::STRING, enumType: Priority::class)]
    private Priority $priority;

    #[ORM\Column(type: Types::STRING, enumType: Status::class)]
    private Status $status;

    public function __construct(string $title, string $description, Priority $priority = Priority::TBD)
    {
        $this->id = Uuid::v7();
        $this->createdAt = Chronos::now();
        $this->updatedAt = null;
        $this->title = $title;
        $this->description = $description;
        $this->priority = $priority;
        $this->status = Status::OPEN;
    }

    public function getId(): AbstractUid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPriority(): Priority
    {
        return $this->priority;
    }

    public function setPriority(Priority $priority): void
    {
        $this->priority = $priority;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }
}
