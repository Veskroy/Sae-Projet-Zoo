<?php

namespace App\Entity;

use App\Repository\SpotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpotRepository::class)]
class Spot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $CodeSpot = null;

    #[ORM\Column(length: 10)]
    private ?string $TypeSpot = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $NameSpot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeSpot(): ?int
    {
        return $this->CodeSpot;
    }

    public function setCodeSpot(?int $CodeSpot): static
    {
        $this->CodeSpot = $CodeSpot;

        return $this;
    }

    public function getTypeSpot(): ?string
    {
        return $this->TypeSpot;
    }

    public function setTypeSpot(string $TypeSpot): static
    {
        $this->TypeSpot = $TypeSpot;

        return $this;
    }

    public function getNameSpot(): ?string
    {
        return $this->NameSpot;
    }

    public function setNameSpot(?string $NameSpot): static
    {
        $this->NameSpot = $NameSpot;

        return $this;
    }
}
