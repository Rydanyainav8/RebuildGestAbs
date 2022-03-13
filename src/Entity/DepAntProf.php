<?php

namespace App\Entity;

use App\Repository\DepAntProfRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepAntProfRepository::class)]
class DepAntProf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $motif;

    #[ORM\Column(type: 'datetime')]
    private $tempDep;

    #[ORM\Column(type: 'datetime')]
    private $tempArr;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: Prof::class, inversedBy: 'depAntProfs')]
    private $prof;

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

    public function getTempDep(): ?\DateTimeInterface
    {
        return $this->tempDep;
    }

    public function setTempDep(\DateTimeInterface $tempDep): self
    {
        $this->tempDep = $tempDep;

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
