<?php

namespace App\Entity;

use App\Repository\FamilyRepository;
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
}
