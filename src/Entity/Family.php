<?php

namespace App\Entity;

use App\Repository\FamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilyRepository::class)]
class Family
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $NameFam = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DescFam = null;

    #[ORM\OneToMany(mappedBy: 'family', targetEntity: Species::class)]
    private Collection $species;

    public function __construct()
    {
        $this->species = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameFam(): ?string
    {
        return $this->NameFam;
    }

    public function setNameFam(?string $NameFam): static
    {
        $this->NameFam = $NameFam;

        return $this;
    }

    public function getDescFam(): ?string
    {
        return $this->DescFam;
    }

    public function setDescFam(?string $DescFam): static
    {
        $this->DescFam = $DescFam;

        return $this;
    }

    /**
     * @return Collection<int, Species>
     */
    public function getSpecies(): Collection
    {
        return $this->species;
    }

    public function addSpecies(Species $species): static
    {
        if (!$this->species->contains($species)) {
            $this->species->add($species);
            $species->setFamily($this);
        }

        return $this;
    }

    public function removeSpecies(Species $species): static
    {
        if ($this->species->removeElement($species)) {
            // set the owning side to null (unless already changed)
            if ($species->getFamily() === $this) {
                $species->setFamily(null);
            }
        }

        return $this;
    }
}
