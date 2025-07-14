<?php

declare(strict_types=1);

namespace App\Domain\Entity\User;

use App\Domain\Entity\LifecycleDates;
use Cake\Chronos\Chronos;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: '`user`')]
class User implements UserInterface
{
    use LifecycleDates;

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    private AbstractUid $id;

    #[ORM\Column(unique: true)]
    private string $email;

    /** @var array<int, string> */
    #[ORM\Column]
    private array $roles;

    #[ORM\Column(nullable: true)]
    private ?string $password;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $verified;

    public function __construct(string $email)
    {
        $this->id = Uuid::v7();
        $this->createdAt = Chronos::now();
        $this->updatedAt = null;
        $this->setEmail($email);
        $this->roles = [Role::USER->value];
        $this->password = null;
        $this->verified = false;
    }

    public function getId(): AbstractUid
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    /**
     * @return array<int, string>
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function markAsVerified(): self
    {
        $this->verified = true;

        return $this;
    }
}
