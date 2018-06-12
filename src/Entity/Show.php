<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Theater;
use App\Entity\Ticket;
use App\Controller\ShowController;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShowRepository")
 * @ORM\Table(name="shows")
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={
 *             "groups"={
 *                 "dashboard-read"
 *             }
 *         },
 *         "denormalization_context"={
 *             "groups"={
 *                 "dashboard-write"
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get","put","delete",
 *         "post"={
 *             "method"="POST",
 *             "path"="/show/{id}/reserved/",
 *             "requirements"={"id"="\d+"},
 *             "controller"=ShowController::class
 *         }
 *     },
 *     collectionOperations ={
 *         "post"={
 *             "method"="POST", "path"="/show/{id}/reserved/"
 *         },
 *          "get"={
 *             "method"="GET", "path"="/shows/"
 *         },
 *     }
 * )
 */
class Show
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $artist;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @Assert\Blank()
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\Blank()
     * @Assert\Url()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @Assert\Blank()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $close;

    /**
     * @var Theater
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Theater", inversedBy="shows")
     */
    private $theater;

    /**
     * @var Ticket[] Available tickets for this show.
     *
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="show")
     *
     */
    private $tickets;

    /**
     * Show constructor.
     */
    public function __construct()
    {
        $this->close = false;
        $this->shows = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        if($this->image != null)
            $this->url = $url;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        if($this->url != null)
            $this->image = $image;

        return $this;
    }

    public function getClose(): ?bool
    {
        return $this->close;
    }

    public function setClose(bool $close): self
    {
        $this->close = $close;

        return $this;
    }

    /**
     * @return Theater
     */
    public function getTheater(): Theater
    {
        return $this->theater;
    }

    /**
     * @param Theater $theater
     */
    public function setTheater(Theater $theater): void
    {
        $this->theater = $theater;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }
}
