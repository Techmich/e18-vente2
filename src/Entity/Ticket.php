<?php

namespace App\Entity;

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
    const SOLD = 'SOLD';
    const RESERVED = 'RESERVED';
    const NONE = 'NONE';

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
     * @Assert\Choice({"SOLD", "RESERVED", "NONE"}, message="Choose a valid status.")
     * @ORM\Column(type="string", length=50)
     */
    private $status;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HistoryBuyTickets", inversedBy="ticket_id")
     */
    private $historyBuyTickets;

    /**
     * Ticket constructor.
     * @param $id2
     */
    public function __construct()
    {
        $this->id2 = Uuid::uuid4();
        $this->status = self::NONE;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
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

    public function getHistoryBuyTickets(): ?HistoryBuyTickets
    {
        return $this->historyBuyTickets;
    }

    public function setHistoryBuyTickets(?HistoryBuyTickets $historyBuyTickets): self
    {
        $this->historyBuyTickets = $historyBuyTickets;

        return $this;
    }

}
