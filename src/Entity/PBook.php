<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PBookRepository")
 */
class PBook
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="pBook", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="pBook")
     */
    private $bookings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Library", inversedBy="pBooks")
     */
    private $library;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="pBooks")
//     * @ORM\JoinColumn(nullable=false)
//     */
//    private $Book;


    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }


//    public function getBook(): ?Book
//    {
//        return $this->book;
//    }
//
//    public function setBook(Book $book): self
//    {
//        $this->book = $book;
//
//        return $this;
//    }


    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setPBook($this);
        }

        return $this;
    }


    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getPBook() === $this) {
                $booking->setPBook(null);
            }
        }

        return $this;
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function setLibrary(?Library $library): self
    {
        $this->library = $library;

        return $this;

    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    /**
     * @param Book|null $book
     * @return PBook
     */
    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;

    }
}
