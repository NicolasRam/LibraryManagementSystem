<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 26/07/18
 * Time: 10:19
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ebook
 *
 * @package App\Entity
 *
 * @ORM\Entity( repositoryClass="App\Repository\EbookRepository" )
 *
 */
class Ebook /*extends Book*/
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Book
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Book")
     */
    private $book;

    /**
     * @var Book
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Book")
     */
    private $file;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MemberEbook", mappedBy="ebook", orphanRemoval=true)
     */
    private $memberEbooks;

    public function __construct()
    {
        $this->memberEbooks = new ArrayCollection();
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }

    /**
     * @param Book $book
     *
     * @return Ebook
     */
    public function setBook(Book $book): Ebook
    {
        $this->book = $book;
        return $this;
    }

    /**
     * @return Collection|MemberEbook[]
     */
    public function getMemberEbooks(): Collection
    {
        return $this->memberEbooks;
    }

    public function addMemberEbook(MemberEbook $memberEbook): self
    {
        if (!$this->memberEbooks->contains($memberEbook)) {
            $this->memberEbooks[] = $memberEbook;
            $memberEbook->setEbook($this);
        }

        return $this;
    }

    public function removeMemberEbook(MemberEbook $memberEbook): self
    {
        if ($this->memberEbooks->contains($memberEbook)) {
            $this->memberEbooks->removeElement($memberEbook);
            // set the owning side to null (unless already changed)
            if ($memberEbook->getEbook() === $this) {
                $memberEbook->setEbook(null);
            }
        }

        return $this;
    }
}