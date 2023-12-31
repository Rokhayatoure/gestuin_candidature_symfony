<?php

namespace App\Entity;


use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CandidatureRepository;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
class Candidature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(type: Types::STRING,length: 50)]
private string $status="ACCEPTER"; 
    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?Formation $formation = null;

    // #[ORM\Column(length: 255)]
    // private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $Formation): static
    {
        $this->formation = $Formation;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $User): static
    {
        $this->user = $User;

        return $this;
    }
}
