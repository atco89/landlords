<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
abstract class Base
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected int $id;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    protected string $uid;

    #[ORM\Column]
    protected DateTimeImmutable $createdAt;

    #[ORM\Column]
    protected DateTimeImmutable $updatedAt;

    #[ORM\Column(nullable: true)]
    protected ?DateTimeImmutable $deletedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    #[ORM\PrePersist]
    public function setPrePersist(): void
    {
        $this->uid = Uuid::v4();
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->deletedAt = null;
    }

    #[ORM\PreUpdate]
    public function setPreUpdate(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    #[ORM\PreRemove]
    public function setPreRemove(): void
    {
        $this->deletedAt = new DateTimeImmutable();
    }
}
