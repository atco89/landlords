<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'users')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User extends Base implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Column]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\Column]
    #[Assert\NotBlank]
    private string $surname;

    #[ORM\Column(unique: true)]
    #[Assert\Email]
    #[Assert\Unique]
    #[Assert\NotBlank]
    private string $email;

    #[ORM\Column]
    #[Assert\NotBlank]
    private string $password;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[Assert\Unique]
    #[Assert\NotBlank]
    private string $activationCode;

    #[ORM\Column]
    #[Assert\NotBlank]
    private bool $activated;

    #[ORM\OneToMany(mappedBy: 'id', targetEntity: Product::class)]
    private Collection $products;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getActivationCode(): string
    {
        return $this->activationCode;
    }

    public function setActivationCode(string $activationCode): self
    {
        $this->activationCode = $activationCode;
        return $this;
    }

    public function isActivated(): bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): self
    {
        $this->activated = $activated;
        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
        $this->password = null;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    #[ORM\PrePersist]
    public function setPrePersist(): void
    {
        parent::setPrePersist();
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->activationCode = Uuid::v4();
        $this->activated = false;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function setProducts(Collection $products): self
    {
        $this->products = $products;
        return $this;
    }
}
