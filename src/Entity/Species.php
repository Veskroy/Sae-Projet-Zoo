<?php

namespace App\Entity;

use App\Repository\SpeciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpeciesRepository::class)]
class Species
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $NameSpe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Diet = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $Origin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Descspe = null;

    #[ORM\ManyToOne(inversedBy: 'species')]
    private ?Family $family = null;

    #[ORM\OneToMany(mappedBy: 'species', targetEntity: Animal::class)]
    private Collection $animal;

    public function __construct()
    {
        $this->animal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSpe(): ?string
    {
        return $this->NameSpe;
    }

    public function setNameSpe(?string $NameSpe): static
    {
        $this->NameSpe = $NameSpe;

        return $this;
    }

    public function getDiet(): ?string
    {
        return $this->Diet;
    }

    public function setDiet(?string $Diet): static
    {
        $this->Diet = $Diet;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->Origin;
    }

    public function setOrigin(?string $Origin): static
    {
        $this->Origin = $Origin;

        return $this;
    }

    public function getDescspe(): ?string
    {
        return $this->Descspe;
    }

    public function setDescspe(?string $Descspe): static
    {
        $this->Descspe = $Descspe;

        return $this;
    }

    public function getFamily(): ?Family
    {
        return $this->family;
    }

    public function setFamily(?Family $family): static
    {
        $this->family = $family;

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
            $animal->setSpecies($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animal->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getSpecies() === $this) {
                $animal->setSpecies(null);
            }
        }

        return $this;
    }
}
