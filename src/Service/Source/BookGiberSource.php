<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 06/08/18
 * Time: 10:43
 */

namespace App\Service\Source;


use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class BookGiberSource
{
    public function getBooks(): array
    {
        $books = [];

        $client = new Client();
        $crawler = $client->request('GET', '/');

        return $books;
    }

    public function getMenu()
    {
        $categories = [];

        $client = new Client();
        $crawler = $client->request('GET', 'https://www.gibert.com/livres-4.html');

        $menu = new Menu();

        $booksMenu = $crawler->filter('li.level0.nav-1.level-top.parent')->first();

        $categoriesCrawler = $booksMenu->filter('li.level1 > a > span');
        $categories = $categoriesCrawler->each(
            function ($crawler) {
                /**
                 * @var SubCategory $subCategories[]
                 */
                $subCategories = [];

                /**
                 * @var Crawler $crawler
                 */
                return $this->getCategory($crawler)->addSubCategory
                (
                    $crawler->filter('li.level1 > a > span')->each(
                        function ( $crawler )
                        {
                            $this->getSubCategory($crawler);
                        }
                    )
                );
            }
        );

        $menu->setCategories( $categories );

        return $menu;
    }

    function getCategory( Crawler $crawler )
    {
        $category = new Category();

        $category->setName( $crawler->text() );

        return $category;
    }


    function getSubCategory( Crawler $crawler )
    {
        $category = new Category();

        $parent = $crawler->parents()->filter('li.level1 > a > span');

        $subCategory = new SubCategory();

        $subCategory->setName( $crawler->text() );
        $subCategory->setLink( $crawler->parents()->filter('li.level1 > a')->link()->getUri() );

        return $category;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return array_keys($this->getMenu());
    }
}

class Menu{
    /**
     * @var array
     */
    private $categories = [];

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     *
     * @return Menu
     */
    public function setCategories(array $categories): Menu
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @param mixed $category
     *
     * @return Menu
     */
    public function addCategory($category) : Menu
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * @param mixed $category
     *
     * @return Menu
     */
    public function removeCategory($category) : Menu
    {
        if (FALSE !== $key = array_search($category, $this->categories, TRUE)) {
            array_splice($this->categories, $key, 1);
        }

        return $this;
    }
}

class Category{
    /**
     * @var string
     */
    private $name = "";

    /**
     * @var array
     */
    private $subCategories = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $subCategory
     *
     * @return Category
     */
    public function addSubCategory($subCategory) : Category
    {
        $this->subCategories[] = $subCategory;

        return $this;
    }

    /**
     * @param mixed $subCategory
     *
     * @return Category
     */
    public function removeSubCategory($subCategory) : Category
    {
        if (FALSE !== $key = array_search($subCategory, $this->subCategories, TRUE)) {
            array_splice($this->subCategories, $key, 1);
        }

        return $this;
    }
}

class SubCategory{
    /**
     * @var string
     */
    private $name = "";

    /**
     * @var string
     */
    private $link = "";

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return SubCategory
     */
    public function setName(string $name): SubCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     *
     * @return SubCategory
     */
    public function setLink(string $link): SubCategory
    {
        $this->link = $link;
        return $this;
    }
}