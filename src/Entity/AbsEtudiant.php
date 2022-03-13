<?php

namespace App\Entity;

use App\Repository\AbsEtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbsEtudiantRepository::class)]
class AbsEtudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $motif;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imgJust;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'absEtudiants')]
    private $etudiant;
    
    public function __construct()
    {
        $this->createdAt =  new \DateTime('now');    
        $this->tempDep =  new \DateTime('now');    
        $this->tempArr =  new \DateTime('now');    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getImgJust(): ?string
    {
        return $this->imgJust;
    }

    public function setImgJust(?string $imgJust): self
    {
        $this->imgJust = $imgJust;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }
}
