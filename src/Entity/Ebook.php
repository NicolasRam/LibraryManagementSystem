<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 26/07/18
 * Time: 10:19
 */

namespace App\Entity;

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
}