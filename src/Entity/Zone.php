<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Zone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nom;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\OneToMany(mappedBy: 'zone', targetEntity: Projet::class)]
    private Collection $projets;

    #[ORM\ManyToMany(targetEntity: Benevole::class, mappedBy: 'zones')]
    private Collection $benevoles;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setZone($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            if ($projet->getZone() === $this) {
                $projet->setZone(null);
            }
        }

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
            $benevole->addZone($this);
        }

        return $this;
    }

    public function removeBenevole(Benevole $benevole): self
    {
        if ($this->benevoles->removeElement($benevole)) {
            $benevole->removeZone($this);
        }

        return $this;
    }
}
