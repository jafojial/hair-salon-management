<?php

namespace App\Entity;

use App\Repository\AvailabilityExceptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvailabilityExceptionRepository::class)]
class AvailabilityException
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'availabilityExceptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salon $salon = null;

    #[ORM\ManyToOne(inversedBy: 'availabilityExceptions')]
    private ?Stylist $stylist = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column]
    private ?bool $closed = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reason = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalon(): ?Salon
    {
        return $this->salon;
    }

    public function setSalon(?Salon $salon): static
    {
        $this->salon = $salon;

        return $this;
    }

    public function getStylist(): ?Stylist
    {
        return $this->stylist;
    }

    public function setStylist(?Stylist $stylist): static
    {
        $this->stylist = $stylist;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function isClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(bool $closed): static
    {
        $this->closed = $closed;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }
}
