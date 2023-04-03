<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'subscriptions')]
#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{

    #[ORM\Id]
    #[ORM\Column(unique: true)]
    #[Assert\Email]
    #[Assert\Unique]
    #[Assert\NotNull]
    private string $email;

    #[ORM\Column]
    #[Assert\NotNull]
    private bool $subscribed;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function isSubscribed(): bool
    {
        return $this->subscribed;
    }

    public function setSubscribed(bool $subscribed): self
    {
        $this->subscribed = $subscribed;
        return $this;
    }
}
