<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Filter\RegexpFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;


/**
 *
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("NONE")
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
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
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $resume;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pageNumber;

    /**
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\Image",
     *     mappedBy="book",
     *     cascade={"persist", "remove"}
     *     )
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     */
    private $author;

//    /**
//     * @var Author[]
//     *
//     * @ORM\ManyToMany(targetEntity="App\Entity\Author", inversedBy="contributedBooks")
//     * @ORM\JoinTable(name="book_author")
//     * @ORM\Column(type="object", nullable=true)
//     */
//    private $authors;

    /**
     * @ORM\OneToOne(targetEntity="EBook", mappedBy="book", cascade={"persist", "remove"})
     */
    private $eBook;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategory", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subCategory;

    /**
     * @ORM\OneToMany(targetEntity="PBook", mappedBy="book", cascade={"persist", "remove"})
     * @ORM\Column(type="object", nullable=true)
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

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     *
     * @return Book
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

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

//    public function getAuthors(): ?array
//    {
//        return $this->authors;
//    }
//
//    public function setAuthors(?array $authors): self
//    {
//        $this->authors = $authors;
//
//        return $this;
//    }

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

//    /**
//     * @param Author $author
//     */
//    public function addAuthor(Author $author)
//    {
//        $this->authors[] = $author;
//    }
//
//    /**
//     * @param Author $author
//     */
//    public function removeAuthor(Author $author)
//    {
//        if (false !== $key = array_search($author, $this->authors, true)) {
//            array_splice($this->authors, $key, 1);
//        }
//    }

    /**
     * @return mixed
     */
    public function getEBook()
    {
        return $this->eBook;
    }

    /**
     * @param mixed $eBook
     *
     * @return Book
     */
    public function setEBook($eBook)
    {
        $this->eBook = $eBook;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }

    /**
     * @param mixed $subCategory
     *
     * @return Book
     */
    public function setSubCategory($subCategory)
    {
        $this->subCategory = $subCategory;

        return $this;
    }
}
