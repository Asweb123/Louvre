<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="smallint")
     */
    private $pricing;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(groups={"beneficiary"})
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit contenir un minimum de {{ limit }} charactères.",
     *      maxMessage = "Votre prénoms doit contenir au maximum {{ limit }} characters",
     *      groups={"beneficiary"}
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir de chiffre.",
     *     groups={"beneficiary"}
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(groups={"beneficiary"})
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit contenir un minimum de {{ limit }} charactères.",
     *      maxMessage = "Votre nom doit contenir au maximum {{ limit }} charactères.",
     *      groups={"beneficiary"}
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir de chiffre.",
     *     groups={"beneficiary"}
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(groups={"beneficiary"})
     * @Assert\Country(groups={"beneficiary"})
     */
    private $country;


    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\Type(
     *     type="bool",
     *     message="Votre choix n'est pas valide.",
     *     groups={"beneficiary"}
     * )
     */
    private $reduction = false;

    /**
     * @ORM\ManyToOne(targetEntity="OrderCustomer", inversedBy="ticketsList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $relatedOrder;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Assert\NotBlank()
     * @Assert\Date()
     * @Assert\LessThan("today")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $price;



    public function getId()
    {
        return $this->id;
    }


    public function getPricing(): ?string
    {
        return $this->pricing;
    }

    public function setPricing(string $pricing): self
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = ucfirst($firstName);

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = ucfirst($lastName);

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getReduction(): ?bool
    {
        return $this->reduction;
    }

    public function setReduction(bool $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getRelatedOrder(): ?OrderCustomer
    {
        return $this->relatedOrder;
    }

    public function setRelatedOrder(?OrderCustomer $relatedOrder): self
    {
        $this->relatedOrder = $relatedOrder;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

}


// Your first name must be at least {{ limit }} characters long.
// Your first name cannot be longer than {{ limit }} characters.
// Your last name must be at least {{ limit }} characters long.
// Your last name cannot be longer than {{ limit }} characters.
// Your name cannot contain a number