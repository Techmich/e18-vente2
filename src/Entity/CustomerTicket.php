<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerTicketRepository")
 * @ORM\Table(name="customers_tickets")
 * @ApiResource(
 *     itemOperations={
 *         "get","put","delete"
 *     },
 *     collectionOperations ={
 *         "get",
 *         "post"={
 *             "method"="POST", "path"="/customer_tickets"
 *         }
 *     }
 * )
 */
class CustomerTicket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $soldAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $reservedAt;

    /**
     * @ORM\Column(type="integer", name="customer_id")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket", inversedBy="ticketUsers")
     * @ORM\JoinColumn(name="ticket_id", nullable=false)
     */
    private $ticket;

    public function getId()
    {
        return $this->id;
    }

    public function getSoldAt(): ?\DateTimeInterface
    {
        return $this->soldAt;
    }

    public function setSoldAt(?\DateTimeInterface $soldAt): self
    {
        $this->soldAt = $soldAt;

        return $this;
    }

    public function getReservedAt(): ?\DateTimeInterface
    {
        return $this->reservedAt;
    }

    public function setReservedAt(?\DateTimeInterface $reservedAt): self
    {
        $this->reservedAt = $reservedAt;

        return $this;
    }

    public function getCustomer(): ?int
    {
        return $this->customer;
    }

    public function setCustomer(int $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }
}