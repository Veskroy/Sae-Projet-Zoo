<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $namevent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEvent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hstartevent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $hendevent = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxiNumPlace = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $desEvent = null;

    #[ORM\ManyToMany(targetEntity: Ticket::class, mappedBy: 'Event')]
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamevent(): ?string
    {
        return $this->namevent;
    }

    public function setNamevent(?string $Namevent): static
    {
        $this->namevent = $Namevent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(?\DateTimeInterface $DateEvent): static
    {
        $this->dateEvent = $DateEvent;

        return $this;
    }

    public function getHstartevent(): ?\DateTimeInterface
    {
        return $this->hstartevent;
    }

    public function setHstartevent(?\DateTimeInterface $Hstartevent): static
    {
        $this->hstartevent = $Hstartevent;

        return $this;
    }

    public function getHendevent(): ?\DateTimeInterface
    {
        return $this->hendevent;
    }

    public function setHendevent(?\DateTimeInterface $Hendevent): static
    {
        $this->hendevent = $Hendevent;

        return $this;
    }

    public function getMaxiNumPlace(): ?int
    {
        return $this->maxiNumPlace;
    }

    public function setMaxiNumPlace(?int $MaxiNumPlace): static
    {
        $this->maxiNumPlace = $MaxiNumPlace;

        return $this;
    }

    public function getDesEvent(): ?string
    {
        return $this->desEvent;
    }

    public function setDesEvent(?string $DesEvent): static
    {
        $this->desEvent = $DesEvent;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->addEvent($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            $ticket->removeEvent($this);
        }

        return $this;
    }

}
