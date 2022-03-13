<?php

namespace App\Entity;

use App\Repository\RetardProfRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RetardProfRepository::class)]
class RetardProf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $motif;

    #[ORM\Column(type: 'datetime')]
    private $tempEns;

    #[ORM\Column(type: 'datetime')]
    private $tempArr;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: Prof::class, inversedBy: 'retardProfs')]
    private $prof;

    public function __construct()
    {
        $this->createdAt =  new \DateTime('now');   
        $this->tempArr = new \DateTime('now') ;
        $this->tempEns = new \DateTime('now') ;
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

    public function getTempEns(): ?\DateTimeInterface
    {
        return $this->tempEns;
    }

    public function setTempEns(\DateTimeInterface $tempEns): self
    {
        $this->tempEns = $tempEns;

        return $this;
    }

    public function getTempArr(): ?\DateTimeInterface
    {
        return $this->tempArr;
    }

    public function setTempArr(\DateTimeInterface $tempArr): self
    {
        $this->tempArr = $tempArr;

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

    public function getProf(): ?Prof
    {
        return $this->prof;
    }

    public function setProf(?Prof $prof): self
    {
        $this->prof = $prof;

        return $this;
    }
}
