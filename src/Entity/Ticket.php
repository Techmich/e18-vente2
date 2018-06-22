<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Show;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Endroid\QrCode\QrCode;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 * @ORM\Table(name="tickets")
 * @ApiResource
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
     * @Assert\NotBlank()
     * @ORM\Column(type="guid", unique=true)
     */
    private $id2;

    /**
     * @var Show
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Show", inversedBy="tickets")
     */
    private $show;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CustomerTicket", mappedBy="ticket", orphanRemoval=true)
     */
    private $ticketUsers;

    /**
     * Ticket constructor.
     * @param $id2
     */
    public function __construct()
    {
        $this->id2 = Uuid::uuid4();
        $this->ticketUsers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getId2(): ?string
    {
        return $this->id2;
    }

    public function setId2(string $id2): self
    {
        $this->id2 = $id2;

        return $this;
    }

    /**
     * @return Show
     */
    public function getShow(): Show
    {
        return $this->show;
    }

    /**
     * @param Show $show
     */
    public function setShow(Show $show): void
    {
        $this->show = $show;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|CustomerTicket[]
     */
    public function getTicketUsers(): Collection
    {
        return $this->ticketUsers;
    }

    public function addTicketUser(CustomerTicket $ticketUser): self
    {
        if (!$this->ticketUsers->contains($ticketUser)) {
            $this->ticketUsers[] = $ticketUser;
            $ticketUser->setTicket($this);
        }

        return $this;
    }

    public function removeTicketUser(CustomerTicket $ticketUser): self
    {
        if ($this->ticketUsers->contains($ticketUser)) {
            $this->ticketUsers->removeElement($ticketUser);
            // set the owning side to null (unless already changed)
            if ($ticketUser->getTicket() === $this) {
                $ticketUser->setTicket(null);
            }
        }

        return $this;
    }

}
