<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $nameEvent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEvent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hStartEvent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hEndEvent = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxNbPlaces = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descEvent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEvent(): ?string
    {
        return $this->nameEvent;
    }

    public function setNameEvent(?string $nameEvent): static
    {
        $this->nameEvent = $nameEvent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(?\DateTimeInterface $dateEvent): static
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getHStartEvent(): ?\DateTimeInterface
    {
        return $this->hStartEvent;
    }

    public function setHStartEvent(?\DateTimeInterface $hStartEvent): static
    {
        $this->hStartEvent = $hStartEvent;

        return $this;
    }

    public function getHEndEvent(): ?\DateTimeInterface
    {
        return $this->hEndEvent;
    }

    public function setHEndEvent(?\DateTimeInterface $hEndEvent): static
    {
        $this->hEndEvent = $hEndEvent;

        return $this;
    }

    public function getMaxNbPlaces(): ?int
    {
        return $this->maxNbPlaces;
    }

    public function setMaxNbPlaces(?int $maxNbPlaces): static
    {
        $this->maxNbPlaces = $maxNbPlaces;

        return $this;
    }

    public function getDescEvent(): ?string
    {
        return $this->descEvent;
    }

    public function setDescEvent(?string $descEvent): static
    {
        $this->descEvent = $descEvent;

        return $this;
    }

}
