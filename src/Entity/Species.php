<?php

namespace App\Entity;

use App\Repository\SpeciesRepository;
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
}
