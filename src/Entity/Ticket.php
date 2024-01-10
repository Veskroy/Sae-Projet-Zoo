<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;


    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'tickets')]
    private Collection $events ;
    
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?User $user = null; // true a modifier

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $Date): static
    {
        $this->date = $Date;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $Price): static
    {
        // les prix possible
        $all_price= [20,12,15,16,0,14];

        if (in_array($Price,$all_price)){
        $this->price = $Price;}

        else
        {$this->price=null;}

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvent(): Collection
    {
        return $this->events;
    }

    public function addEvent(event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        $this->events->removeElement($event);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $Type): static
    {
        // les Types de ticket possible
        $all_type= ['ENFANT','ETUDIANT','SENIOR','JUNIOR','HANDICAPE',null,''];
            if(in_array($Type,$all_type)){
        $this->type = $Type;}
            else
            {$this->type=null;}
        return $this;
    }

}
