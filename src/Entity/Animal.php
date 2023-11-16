<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $NameAnm = null;

    #[ORM\Column(nullable: true)]
    private ?int $Gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DescAnm = null;

    #[ORM\Column(nullable: true)]
    private ?float $Weight = null;

    #[ORM\Column(nullable: true)]
    private ?float $Size = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $BirthDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameAnm(): ?string
    {
        return $this->NameAnm;
    }

    public function setNameAnm(string $NameAnm): static
    {
        $this->NameAnm = $NameAnm;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->Gender;
    }

    public function setGender(?int $Gender): static
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getDescAnm(): ?string
    {
        return $this->DescAnm;
    }

    public function setDescAnm(?string $DescAnm): static
    {
        $this->DescAnm = $DescAnm;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->Weight;
    }

    public function setWeight(?float $Weight): static
    {
        $this->Weight = $Weight;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->Size;
    }

    public function setSize(?float $Size): static
    {
        $this->Size = $Size;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(?\DateTimeInterface $BirthDate): static
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }
}
