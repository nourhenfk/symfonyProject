<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $dateInscription;

    #[ORM\ManyToOne(targetEntity: Benevole::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private Benevole $benevole;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private Projet $projet;

    // Getters and Setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): DateTimeImmutable
    {
        return $this->dateInscription;
    }

    public function setDateInscription(DateTimeImmutable $dateInscription): self
    {
        $this->dateInscription = $dateInscription;
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

    public function getProjet(): Projet
    {
        return $this->projet;
    }

    public function setProjet(Projet $projet): self
    {
        $this->projet = $projet;
        return $this;
    }
}
