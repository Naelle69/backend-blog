<?php

namespace App\Entity;

use App\Enum\SubscriptionTypeEnum;
use App\Repository\NewsletterSubscriberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsletterSubscriberRepository::class)]
class NewsletterSubscriber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column]
    private ?\DateTime $subscribedAt = null;

    #[ORM\Column(enumType: SubscriptionTypeEnum::class)]
    private ?SubscriptionTypeEnum $subscriptionType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSubscribedAt(): ?\DateTime
    {
        return $this->subscribedAt;
    }

    public function setSubscribedAt(\DateTime $subscribedAt): static
    {
        $this->subscribedAt = $subscribedAt;

        return $this;
    }

    public function getSubscriptionType(): ?SubscriptionTypeEnum
    {
        return $this->subscriptionType;
    }

    public function setSubscriptionType(SubscriptionTypeEnum $subscriptionType): static
    {
        $this->subscriptionType = $subscriptionType;

        return $this;
    }
}
