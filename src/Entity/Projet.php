<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTimeImmutable;

#[ORM\Entity]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nom;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $dateDebut;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $dateFin;

    #[ORM\Column(type: 'integer')]
    private int $nombreBenevolesNecessaires;

    #[ORM\ManyToOne(targetEntity: Association::class, inversedBy: 'projets')]
    #[ORM\JoinColumn(nullable: false)]
    private Association $association;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Mission::class)]
    private Collection $missions;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'projets')]
    #[ORM\JoinColumn(nullable: false)]
    private Zone $zone;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'projets')]
    #[ORM\JoinColumn(nullable: false)]
    private Categorie $categorie;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
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

    public function getDateDebut(): DateTimeImmutable
    {
        return $this->dateDebut;
    }

    public function setDateDebut(DateTimeImmutable $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function getDateFin(): DateTimeImmutable
    {
        return $this->dateFin;
    }

    public function setDateFin(DateTimeImmutable $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    public function getNombreBenevolesNecessaires(): int
    {
        return $this->nombreBenevolesNecessaires;
    }

    public function setNombreBenevolesNecessaires(int $nombreBenevolesNecessaires): self
    {
        $this->nombreBenevolesNecessaires = $nombreBenevolesNecessaires;
        return $this;
    }

    public function getAssociation(): Association
    {
        return $this->association;
    }

    public function setAssociation(Association $association): self
    {
        $this->association = $association;
        return $this;
    }

    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->setProjet($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            if ($mission->getProjet() === $this) {
                $mission->setProjet(null);
            }
        }

        return $this;
    }

    public function getZone(): Zone
    {
        return $this->zone;
    }

    public function setZone(Zone $zone): self
    {
        $this->zone = $zone;
        return $this;
    }

    public function getCategorie(): Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(Categorie $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }
}
