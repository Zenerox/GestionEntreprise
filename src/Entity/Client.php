<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\ClientRepository;
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
    private $tel_number;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Merci de saisir une date de naissance")
     */
    private $birth_date;

    /**
     * @ORM\OneToOne(targetEntity=Rdv::class, mappedBy="Client", cascade={"persist", "remove"})
     */
    private $Date;

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
        return $this->tel_number;
    }

    public function setTelNumber(string $tel_number): self
    {
        $this->tel_number = $tel_number;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getIdentity(): string
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function getDate(): ?Rdv
    {
        return $this->Date;
    }

    public function setDate(Rdv $Date): self
    {
        // set the owning side of the relation if necessary
        if ($Date->getClient() !== $this) {
            $Date->setClient($this);
        }

        $this->Date = $Date;

        return $this;
    }
}
