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
    private ?string $Namevent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateEvent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Hstartevent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Hendevent = null;

    #[ORM\Column(nullable: true)]
    private ?int $MaxiNumPlace = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DesEvent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamevent(): ?string
    {
        return $this->Namevent;
    }

    public function setNamevent(?string $Namevent): static
    {
        $this->Namevent = $Namevent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->DateEvent;
    }

    public function setDateEvent(?\DateTimeInterface $DateEvent): static
    {
        $this->DateEvent = $DateEvent;

        return $this;
    }

    public function getHstartevent(): ?\DateTimeInterface
    {
        return $this->Hstartevent;
    }

    public function setHstartevent(?\DateTimeInterface $Hstartevent): static
    {
        $this->Hstartevent = $Hstartevent;

        return $this;
    }

    public function getHendevent(): ?\DateTimeInterface
    {
        return $this->Hendevent;
    }

    public function setHendevent(?\DateTimeInterface $Hendevent): static
    {
        $this->Hendevent = $Hendevent;

        return $this;
    }

    public function getMaxiNumPlace(): ?int
    {
        return $this->MaxiNumPlace;
    }

    public function setMaxiNumPlace(?int $MaxiNumPlace): static
    {
        $this->MaxiNumPlace = $MaxiNumPlace;

        return $this;
    }

    public function getDesEvent(): ?string
    {
        return $this->DesEvent;
    }

    public function setDesEvent(?string $DesEvent): static
    {
        $this->DesEvent = $DesEvent;

        return $this;
    }

}
