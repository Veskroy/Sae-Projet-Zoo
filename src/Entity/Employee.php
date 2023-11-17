<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idSupEmp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSupEmp(): ?int
    {
        return $this->idSupEmp;
    }

    public function setIdSupEmp(int $idSupEmp): static
    {
        $this->idSupEmp = $idSupEmp;

        return $this;
    }
}
