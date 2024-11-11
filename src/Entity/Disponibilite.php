<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Disponibilite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $joursDisponibles;

    #[ORM\Column(type: 'string', length: 255)]
    private string $heuresDisponibles;

    #[ORM\ManyToOne(targetEntity: Benevole::class, inversedBy: 'disponibilites')]
    #[ORM\JoinColumn(nullable: false)]
    private Benevole $benevole;

    // Getters and Setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJoursDisponibles(): string
    {
        return $this->joursDisponibles;
    }

    public function setJoursDisponibles(string $joursDisponibles): self
    {
        $this->joursDisponibles = $joursDisponibles;
        return $this;
    }

    public function getHeuresDisponibles(): string
    {
        return $this->heuresDisponibles;
    }

    public function setHeuresDisponibles(string $heuresDisponibles): self
    {
        $this->heuresDisponibles = $heuresDisponibles;
        return $this;
    }

    public function getBenevole(): Benevole
    {
        return $this->benevole;
    }

    public function setBenevole(Benevole $benevole): self
    {
        $this->benevole = $benevole;
        return $this;
    }
}
