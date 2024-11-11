<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nom;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    private Projet $projet;

    #[ORM\ManyToMany(targetEntity: Benevole::class, inversedBy: 'missions')]
    private Collection $benevoles;

    public function __construct()
    {
        $this->benevoles = new ArrayCollection();
    }

    // Getters and Setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
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

    public function getBenevoles(): Collection
    {
        return $this->benevoles;
    }

    public function addBenevole(Benevole $benevole): self
    {
        if (!$this->benevoles->contains($benevole)) {
            $this->benevoles->add($benevole);
        }

        return $this;
    }

    public function removeBenevole(Benevole $benevole): self
    {
        $this->benevoles->removeElement($benevole);
        return $this;
    }
}
