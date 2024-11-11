<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $message;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $dateNotification;

    #[ORM\ManyToOne(targetEntity: Benevole::class, inversedBy: 'notifications')]
    #[ORM\JoinColumn(nullable: false)]
    private Benevole $benevole;

    // Getters and Setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getDateNotification(): DateTimeImmutable
    {
        return $this->dateNotification;
    }

    public function setDateNotification(DateTimeImmutable $dateNotification): self
    {
        $this->dateNotification = $dateNotification;
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
