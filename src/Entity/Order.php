<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $bookingDate;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ticketsNumber;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ticketType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailCustomer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bookingRef;

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

    public function getTicketsNumber(): ?int
    {
        return $this->ticketsNumber;
    }

    public function setTicketsNumber(int $ticketsNumber): self
    {
        $this->ticketsNumber = $ticketsNumber;

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
}
