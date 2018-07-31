<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 *
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("NONE")
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 *
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isbn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $resume;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pageNumber;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $cover;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Author", inversedBy="contributedBooks")
     * @ORM\JoinTable(name="book_author")
     */
    private $authors;

    /**
     * @ORM\OneToMany(targetEntity="PBook", mappedBy="book", cascade={"persist", "remove"})
     */
    private $pBook;

    public function getId()
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
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

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPageNumber(): ?int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(?int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function setCover($cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthors(): ?array
    {
        return $this->authors;
    }

    public function setAuthors(?array $authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    public function getPBook(): ?PBook
    {
        return $this->pBook;
    }

    public function setPBook(PBook $pBook): self
    {
        $this->pBook = $pBook;

        // set the owning side of the relation if necessary
        if ($this !== $pBook->getBook()) {
            $pBook->setBook($this);
        }

        return $this;
    }
}
