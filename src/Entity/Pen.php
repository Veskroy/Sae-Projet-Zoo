<?php

namespace App\Entity;

use App\Repository\PenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PenRepository::class)]
class Pen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $Capacity = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $TypePen = null;

    #[ORM\Column(nullable: true)]
    private ?float $SizePen = null;

    #[ORM\Column(nullable: true)]
    private ?int $Numplace = null;

    #[ORM\OneToMany(mappedBy: 'pen', targetEntity: Animal::class)]
    private Collection $animal;

    public function __construct()
    {
        $this->animal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacity(): ?int
    {
        return $this->Capacity;
    }

    public function setCapacity(?int $Capacity): static
    {
        $this->Capacity = $Capacity;

        return $this;
    }

    public function getTypePen(): ?string
    {
        return $this->TypePen;
    }

    public function setTypePen(?string $TypePen): static
    {
        $this->TypePen = $TypePen;

        return $this;
    }

    public function getSizePen(): ?float
    {
        return $this->SizePen;
    }

    public function setSizePen(?float $SizePen): static
    {
        $this->SizePen = $SizePen;

        return $this;
    }

    public function getNumplace(): ?int
    {
        return $this->Numplace;
    }

    public function setNumplace(?int $Numplace): static
    {
        $this->Numplace = $Numplace;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimal(): Collection
    {
        return $this->animal;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animal->contains($animal)) {
            $this->animal->add($animal);
            $animal->setPen($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animal->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getPen() === $this) {
                $animal->setPen(null);
            }
        }

        return $this;
    }
}
