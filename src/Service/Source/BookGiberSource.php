<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 06/08/18
 * Time: 10:43
 */

namespace App\Service\Source;


use App\Service\Source\Entity\Book;
use Goutte\Client;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\DomCrawler\Crawler;

class BookGiberSource
{
    /**
     * @param string $url
     *
     * @return array
     */
    public function getBooks( $url = '' ) : array
    {
        $books = [];

        if( $url !== '' )
        {
            $client = new Client();
            $crawler = $client->request('GET', $url);

            $books = $crawler->filter('li.item.product.product-item')->each(
                function ($crawler)
                {
                    $book = new Entity\Book();

                    /**
                     * @var Crawler $crawler
                     */
                    $book->setTitle(trim($crawler->filter('div.product.details.product-item-details > strong > a')->text()));

                    $book->setImage($crawler->filter('div.product-item-info > a > span > span > img')->image()->getUri());
                    $book->setAuthor($crawler->filter('div.product.details.product-item-details > p.author > a')->text());
                    $book->setUrl($crawler->filter('div.product.details.product-item-details > strong > a')->link()->getUri());

                    $this->getBookDetails( $book );

                    return $book;
                }
            );
        }

        return $books;
    }

    public function getBookDetails( Book $book )
    {
        if( $book->getUrl() !== '' )
        {
            $client = new Client();
            $crawler = $client->request('GET', $book->getUrl() );

//            $bookCrawler = $crawler->filter('div.product-info-main');

//            $book->setTitle($bookCrawler->filter('h1.page-title > span')->text());
//            $book->setImage($bookCrawler->filter('div.product-item-info > a > span > span > img')->image()->getUri());
//            $book->setAuthor($bookCrawler->filter('div.product.details.product-item-details > p.author > a')->text());
//            $book->setUrl($bookCrawler->filter('div.product.details.product-item-details > strong > a')->getUri());

            if($crawler->filter('div.product.attribute.description > div.value')->count() > 0)
                $book->setResume($crawler->filter('div.product.attribute.description > div.value')->text());

            //            $book->setContribs( $bookCrawler->filter('div.product.attribute.description > div.value')->text() );
//            $book->setPriceNew($bookCrawler->filter('[rel="stylesheet"],[type="text/css"]'));
//            $book->setPriceUsed();
//            $book->setState();

//            dd($bookCrawler->filter('div.product.attribute.description > div.value')->text());

        }
    }

    /**
     * @return \App\Service\Source\Entity\Menu
     */
    public function getMenu()
    {
        $categories = [];

        $client = new Client();
        $crawler = $client->request('GET', 'https://www.gibert.com/livres-4.html');

        $menu = new Entity\Menu();

        $booksMenu = $crawler->filter('li.level0.nav-1.level-top.parent')->first();

        $categoriesCrawler = $booksMenu->filter('li.level1');
        $categories = $categoriesCrawler->each
        (
            function ($crawler)
            {
                /**
                 * @var Crawler $crawler
                 */
                $category = $this->getCategory($crawler);

                $subCategories = $crawler->filter('li.level2')->each
                (
                    /**
                     * @var Crawler $crawler
                     */
                    function ( $crawler )
                    {
                        return $this->getSubCategory($crawler);
                    }
                );

                $category->setSubCategories( $subCategories );

                return $category;
            }
        );

        $menu->setCategories( $categories );

        return $menu;
    }

    /**
     * @param Crawler $crawler
     *
     * @return \App\Service\Source\Entity\Category
     */
    function getCategory( Crawler $crawler )
    {
        $category = new Entity\Category();

        $category->setName( $crawler->filter('a > span')->text() );

        return $category;
    }

    /**
     * @param Crawler $crawler
     *
     * @return \App\Service\Source\Entity\SubCategory
     */
    function getSubCategory( Crawler $crawler )
    {
        $subCategory = new Entity\SubCategory();

        $subCategory->setName( $crawler->filter('a > span')->text() );
        $subCategory->setLink( $crawler->filter('a')->link()->getUri() );

        return $subCategory;
    }
}