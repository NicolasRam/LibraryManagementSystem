<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 11:39
 */

namespace App\Service\Source\Entity;

use App\Service\Source\Entity\BookContrib;
use App\Service\Source\Entity\BookDetail;

class Book
{
    /**
     * @var String
     */
    private $title = '';

    /**
     * @var String
     */
    private $image = '';

    /**
     * @var String
     */
    private $url = '';

    /**
     * @var String
     */
    private $resume = '';

    /**
     * @var String
     */
    private $author = '';

    /**
     * @var String
     */
    private $priceNew = '';

    /**
     * @var String
     */
    private $priceUsed = '';

    /**
     * @var String
     */
    private $state = '';

    /**
     * @var string
     */
    private $isbn = '';

    /**
     * @var BookContrib[]
     */
    private $details = [];

    /**
     * @var BookDetail[]
     */
    private $contribs = [];

    /**
     * @return String
     */
    public function getTitle(): String
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn(string $isbn): Book
    {
        $this->isbn = $isbn;
        return $this;
    }



    /**
     * @param String $title
     *
     * @return Book
     */
    public function setTitle(String $title): Book
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return String
     */
    public function getImage(): String
    {
        return $this->image;
    }

    /**
     * @param String $image
     *
     * @return Book
     */
    public function setImage(String $image): Book
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return String
     */
    public function getUrl(): String
    {
        return $this->url;
    }

    /**
     * @param String $url
     *
     * @return Book
     */
    public function setUrl(String $url): Book
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return String
     */
    public function getResume(): String
    {
        return $this->resume;
    }

    /**
     * @param String $resume
     *
     * @return Book
     */
    public function setResume(String $resume): Book
    {
        $this->resume = $resume;
        return $this;
    }

    /**
     * @return String
     */
    public function getAuthor(): String
    {
        return $this->author;
    }

    /**
     * @param String $author
     *
     * @return Book
     */
    public function setAuthor(String $author): Book
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return String
     */
    public function getPriceNew(): String
    {
        return $this->priceNew;
    }

    /**
     * @param String $priceNew
     *
     * @return Book
     */
    public function setPriceNew(String $priceNew): Book
    {
        $this->priceNew = $priceNew;
        return $this;
    }

    /**
     * @return String
     */
    public function getPriceUsed(): String
    {
        return $this->priceUsed;
    }

    /**
     * @param String $priceUsed
     *
     * @return Book
     */
    public function setPriceUsed(String $priceUsed): Book
    {
        $this->priceUsed = $priceUsed;
        return $this;
    }

    /**
     * @return String
     */
    public function getState(): String
    {
        return $this->state;
    }

    /**
     * @param String $state
     *
     * @return Book
     */
    public function setState(String $state): Book
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return BookContrib[]
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @param BookContrib[] $details
     *
     * @return Book
     */
    public function setDetails(array $details): Book
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @return BookDetail[]
     */
    public function getContribs(): array
    {
        return $this->contribs;
    }

    /**
     * @param BookDetail[] $contribs
     *
     * @return Book
     */
    public function setContribs(array $contribs): Book
    {
        $this->contribs = $contribs;
        return $this;
    }

    /**
     * @param BookContrib $detail
     */
    public function addDetail(BookContrib $detail)
    {
        $this->details[] = $detail;
    }

    /**
     * @param BookContrib $detail
     */
    public function removeDetail(BookContrib $detail)
    {
        if (FALSE !== $key = array_search($detail, $this->details, TRUE)) {
            array_splice($this->details, $key, 1);
        }
    }

    /**
     * @param BookDetail $contrib
     */
    public function addContrib(BookDetail $contrib)
    {
        $this->contribs[] = $contrib;
    }

    /**
     * @param BookDetail $contrib
     */
    public function removeContrib(BookDetail $contrib)
    {
        if (FALSE !== $key = array_search($contrib, $this->contribs, TRUE)) {
            array_splice($this->contribs, $key, 1);
        }
    }
}