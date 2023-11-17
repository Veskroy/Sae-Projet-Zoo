<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(nullable: true)]
    private ?int $Price = null;

    #[ORM\Column(nullable: true)]
    private ?int $Period = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTck(): ?int
    {
        return $this->IdTck;
    }

    public function setIdTck(?int $IdTck): static
    {
        $this->IdTck = $IdTck;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(?int $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getPeriod(): ?int
    {
        return $this->Period;
    }

    public function setPeriod(?int $Period): static
    {
        $this->Period = $Period;

        return $this;
    }
}
