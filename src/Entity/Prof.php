<?php

namespace App\Entity;

use App\Repository\ProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProfRepository::class)]
#[UniqueEntity(fields: "email", message: "Email déja utilisée")]
class Prof implements UserInterface, PasswordAuthenticatedUserInterface
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
    private $photo;

    #[ORM\OneToMany(mappedBy: 'prof', targetEntity: Module::class)]
    private $modules;

    #[ORM\OneToMany(mappedBy: 'prof', targetEntity: AbsProf::class)]
    private $absProfs;

    #[ORM\OneToMany(mappedBy: 'prof', targetEntity: DepAntProf::class)]
    private $depAntProfs;

    #[ORM\OneToMany(mappedBy: 'prof', targetEntity: RetardProf::class)]
    private $retardProfs;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->absProfs = new ArrayCollection();
        $this->depAntProfs = new ArrayCollection();
        $this->retardProfs = new ArrayCollection();
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
        $this->lastname = strtoupper($lastname);

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
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setProf($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getProf() === $this) {
                $module->setProf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AbsProf>
     */
    public function getAbsProfs(): Collection
    {
        return $this->absProfs;
    }

    public function addAbsProf(AbsProf $absProf): self
    {
        if (!$this->absProfs->contains($absProf)) {
            $this->absProfs[] = $absProf;
            $absProf->setProf($this);
        }

        return $this;
    }

    public function removeAbsProf(AbsProf $absProf): self
    {
        if ($this->absProfs->removeElement($absProf)) {
            // set the owning side to null (unless already changed)
            if ($absProf->getProf() === $this) {
                $absProf->setProf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DepAntProf>
     */
    public function getDepAntProfs(): Collection
    {
        return $this->depAntProfs;
    }

    public function addDepAntProf(DepAntProf $depAntProf): self
    {
        if (!$this->depAntProfs->contains($depAntProf)) {
            $this->depAntProfs[] = $depAntProf;
            $depAntProf->setProf($this);
        }

        return $this;
    }

    public function removeDepAntProf(DepAntProf $depAntProf): self
    {
        if ($this->depAntProfs->removeElement($depAntProf)) {
            // set the owning side to null (unless already changed)
            if ($depAntProf->getProf() === $this) {
                $depAntProf->setProf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RetardProf>
     */
    public function getRetardProfs(): Collection
    {
        return $this->retardProfs;
    }

    public function addRetardProf(RetardProf $retardProf): self
    {
        if (!$this->retardProfs->contains($retardProf)) {
            $this->retardProfs[] = $retardProf;
            $retardProf->setProf($this);
        }

        return $this;
    }

    public function removeRetardProf(RetardProf $retardProf): self
    {
        if ($this->retardProfs->removeElement($retardProf)) {
            // set the owning side to null (unless already changed)
            if ($retardProf->getProf() === $this) {
                $retardProf->setProf(null);
            }
        }

        return $this;
    }
}
