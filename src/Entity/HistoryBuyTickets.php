<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoryBuyTicketsRepository")
 */
class HistoryBuyTickets
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
    private $Sold_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="historyBuyTickets")
     */
    private $ticket_id;

    public function __construct()
    {
        $this->ticket_id = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSoldDate(): ?\DateTimeInterface
    {
        return $this->Sold_date;
    }

    public function setSoldDate(\DateTimeInterface $Sold_date): self
    {
        $this->Sold_date = $Sold_date;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTicketId(): Collection
    {
        return $this->ticket_id;
    }

    public function addTicketId(Ticket $ticketId): self
    {
        if (!$this->ticket_id->contains($ticketId)) {
            $this->ticket_id[] = $ticketId;
            $ticketId->setHistoryBuyTickets($this);
        }

        return $this;
    }

    public function removeTicketId(Ticket $ticketId): self
    {
        if ($this->ticket_id->contains($ticketId)) {
            $this->ticket_id->removeElement($ticketId);
            // set the owning side to null (unless already changed)
            if ($ticketId->getHistoryBuyTickets() === $this) {
                $ticketId->setHistoryBuyTickets(null);
            }
        }

        return $this;
    }
}
