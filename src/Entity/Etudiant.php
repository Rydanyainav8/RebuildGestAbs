<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
#[UniqueEntity(fields: "email", message: "Email déja utilisée")]
class Etudiant implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\Email(message: "Adresse email non valide")]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    #[Assert\Length(min: 8, minMessage: "Votre mot de passe doit avoir {{ limit }} caractères minimum")]

    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private $grade;

    #[ORM\Column(type: 'string', length: 255)]
    private $photo;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: RetardEtudiant::class)]
    private $retardEtudiants;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: DepAntEtudiant::class)]
    private $depAntEtudiants;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: AbsEtudiant::class)]
    private $absEtudiants;

    public function __construct()
    {
        $this->retardEtudiants = new ArrayCollection();
        $this->depAntEtudiants = new ArrayCollection();
        $this->absEtudiants = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->email;   
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $up = strtoupper($lastname);
        $this->lastname = $up;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, RetardEtudiant>
     */
    public function getRetardEtudiants(): Collection
    {
        return $this->retardEtudiants;
    }

    public function addRetardEtudiant(RetardEtudiant $retardEtudiant): self
    {
        if (!$this->retardEtudiants->contains($retardEtudiant)) {
            $this->retardEtudiants[] = $retardEtudiant;
            $retardEtudiant->setEtudiant($this);
        }

        return $this;
    }

    public function removeRetardEtudiant(RetardEtudiant $retardEtudiant): self
    {
        if ($this->retardEtudiants->removeElement($retardEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($retardEtudiant->getEtudiant() === $this) {
                $retardEtudiant->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DepAntEtudiant>
     */
    public function getDepAntEtudiants(): Collection
    {
        return $this->depAntEtudiants;
    }

    public function addDepAntEtudiant(DepAntEtudiant $depAntEtudiant): self
    {
        if (!$this->depAntEtudiants->contains($depAntEtudiant)) {
            $this->depAntEtudiants[] = $depAntEtudiant;
            $depAntEtudiant->setEtudiant($this);
        }

        return $this;
    }

    public function removeDepAntEtudiant(DepAntEtudiant $depAntEtudiant): self
    {
        if ($this->depAntEtudiants->removeElement($depAntEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($depAntEtudiant->getEtudiant() === $this) {
                $depAntEtudiant->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AbsEtudiant>
     */
    public function getAbsEtudiants(): Collection
    {
        return $this->absEtudiants;
    }

    public function addAbsEtudiant(AbsEtudiant $absEtudiant): self
    {
        if (!$this->absEtudiants->contains($absEtudiant)) {
            $this->absEtudiants[] = $absEtudiant;
            $absEtudiant->setEtudiant($this);
        }

        return $this;
    }

    public function removeAbsEtudiant(AbsEtudiant $absEtudiant): self
    {
        if ($this->absEtudiants->removeElement($absEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($absEtudiant->getEtudiant() === $this) {
                $absEtudiant->setEtudiant(null);
            }
        }

        return $this;
    }
}
