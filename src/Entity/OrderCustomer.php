<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as OrderAssert;

/**
 * @ORM\Entity(repositoryClass="OrderCustomerRepository")
 *
 * @OrderAssert\PmTodayTicket(groups={"booking"})
 * @OrderAssert\MaxTicketsQuantity(groups={"booking"})
 */
class OrderCustomer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     *
     * @OrderAssert\TodayClosing(groups={"booking"})
     * @OrderAssert\SundayBookingDisabled(groups={"booking"})
     * @OrderAssert\TuesdayBookingDisabled(groups={"booking"})
     * @OrderAssert\PublicHolidayBookingDisabled(groups={"booking"})
     * @Assert\NotBlank(groups={"booking"})
     * @Assert\Date(groups={"booking"})
     * @Assert\GreaterThanOrEqual("today",
     *     groups={"booking"},
     *     message= "La date choisie est invalide ."
     * )
     */
    private $bookingDate;

    /**
     * * @ORM\Column(type="smallint")
     *
     * @Assert\NotBlank(groups={"booking"})
     * @Assert\Type(groups={"booking"},
     *     type="integer",
     *     message="Cette valeur n'est pas un nombre valide."
     * )
     * @Assert\Range(groups={"booking"},
     *     min = 1,
     *     max = 15,
     *     minMessage = "Veuillez choisir au moins 1 billet.",
     *     maxMessage = "Veuillez choisir au maximum 15 billets"
     * )
     */
    private $ticketsQuantity;

    /**
     * @ORM\Column(type="smallint")
     *
     * @Assert\NotBlank(groups={"booking"})
     * @Assert\Choice(
     *     { 1, 2 },
     *
     *     groups={"booking"}
     * )
     */
    private $ticketType;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(groups={"payment"})
     * @Assert\Email(
     *     message = "L'adresse mail '{{ value }}' n\'est pas une adresse valide.",
     *     checkMX = true,
     *     groups={"booking"}
     * )
     */
    private $emailCustomer;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $bookingRef;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="relatedOrder", orphanRemoval=true, cascade={"persist"})
     *
     * @Assert\Valid
     */
    private $ticketsList;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $totalPrice;


    public function __construct()
    {
        $this->ticketsList = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBookingDate(): ?\DateTimeInterface
    {
        return $this->bookingDate;
    }

    public function setBookingDate(\DateTimeInterface $bookingDate): self
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    public function getTicketsQuantity(): ?int
    {
        return $this->ticketsQuantity;
    }

    public function setTicketsQuantity(int $ticketsQuantity): self
    {
        $this->ticketsQuantity = $ticketsQuantity;

        return $this;
    }

    public function getTicketType(): ?int
    {
        return $this->ticketType;
    }

    public function setTicketType(int $ticketType): self
    {
        $this->ticketType = $ticketType;

        return $this;
    }

    public function getEmailCustomer(): ?string
    {
        return $this->emailCustomer;
    }

    public function setEmailCustomer(string $emailCustomer): self
    {
        $this->emailCustomer = $emailCustomer;

        return $this;
    }

    public function getBookingRef(): ?string
    {
        return $this->bookingRef;
    }

    public function setBookingRef(string $bookingRef): self
    {
        $this->bookingRef = $bookingRef;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTicketsList(): Collection
    {
        return $this->ticketsList;
    }

    public function addTicketsList(Ticket $ticketsList): self
    {
        if (!$this->ticketsList->contains($ticketsList)) {
            $this->ticketsList[] = $ticketsList;
            $ticketsList->setRelatedOrder($this);
        }

        return $this;
    }

    public function removeTicketsList(Ticket $ticketsList): self
    {
        if ($this->ticketsList->contains($ticketsList)) {
            $this->ticketsList->removeElement($ticketsList);
            // set the owning side to null (unless already changed)
            if ($ticketsList->getRelatedOrder() === $this) {
                $ticketsList->setRelatedOrder(null);
            }
        }

        return $this;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function setTotalPrice($totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

}

// This value should be greater than or equal to today's date.
// The value is not a valid number.
// Please choose at least 1 ticket.
// Please choose 15 tickets or less.
// The email '{{ value }}' is not a valid email.
