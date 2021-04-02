<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Client
{

    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message="Merci de saisir un prénom")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank(message="Merci de saisir un nom")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=75, unique=true)
     * @Assert\NotBlank(message="Merci de saisir une adresse mail")
     * @Assert\Email(message="Merci de saisir une adresse valide")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message="Merci de saisir un numéro de contact")
     */
    private $telNumber;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Merci de saisir une date de naissance")
     */
    private $birthDate;

    /**
     * @ORM\OneToMany(targetEntity=Rdv::class, mappedBy="Client", cascade={"persist", "remove"})
     */
    private $rdvs;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $codePostal;

    public function __construct()
    {
        $this->rdvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
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

    public function getTelNumber(): ?string
    {
        return $this->telNumber;
    }

    public function setTelNumber(string $telNumber): self
    {
        $this->telNumber = $telNumber;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getIdentity(): string
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function getRdvs(): Collection
    {
        return $this->rdvs;
    }

    public function addRdv(Rdv $rdv): self
    {
        if (!$this->rdvs->contains($rdv)) {
            $this->rdvs[] = $rdv;
            $rdv->setClient($this);
        }

        return $this;
    }

    public function removeRdv(Rdv $rdv): self
    {
        if ($this->rdvs->contains($rdv)) {
            $this->rdvs->removeElement($rdv);
            // set the owning side to null (unless already changed)
            if ($rdv->getClient() === $this) {
                $rdv->setClient(null);
            }
        }

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }
}
