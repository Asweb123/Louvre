<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
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
     * @Assert\NotBlank(groups={"booking"})
     * @Assert\Date(groups={"booking"})
     */
    private $bookingDate;

    /**
     *
     * @Assert\Range( groups={"booking"},
     *     min = 1,
     *     max = 1000,
     *     minMessage = "Veuillez choisir 1 billet au minimum",
     *     maxMessage = "Veuilez choisir 1000 billets au maximum"
     * )
     */
    private $ticketsQuantity;

    /**
     * @ORM\Column(type="smallint")
     *
     * @Assert\NotBlank(groups={"booking"})
     */
    private $ticketType;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $emailCustomer;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $bookingRef;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="relatedOrder", orphanRemoval=true)
     */
    private $ticketsList;

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
}
