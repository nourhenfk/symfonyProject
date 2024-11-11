<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "association")]
class Association extends Utilisateur
{

    #[ORM\Column(type: 'string', length: 255)]
    private string $secteurActivite;
    #[ORM\Column(type: 'string', length: 255)]
    private string $statutJuridique;

    #[ORM\Column(type: 'string', length: 255)]
    private string $siteWeb ;


    #[ORM\OneToMany(mappedBy: 'association', targetEntity: Projet::class)]
    private Collection $projets;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }

    // Getters and Setters...

    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setAssociation($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            if ($projet->getAssociation() === $this) {
                $projet->setAssociation(null);
            }
        }

        return $this;
    }
}
