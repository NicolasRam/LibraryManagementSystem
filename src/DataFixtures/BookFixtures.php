<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Behat\Transliterator\Transliterator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BookFixtures extends Fixture implements OrderedFixtureInterface
{
    public const BOOKS_REFERENCE = 'books';
    public const BOOKS_COUNT_REFERENCE = 10;

    public function __construct()
    {
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');
        $authors = [];

        for ($i = 0; $i < AuthorFixtures::AUTHORS_COUNT_REFERENCE; $i++) {
            $authors[] = $this->getReference(AuthorFixtures::AUTHORS_REFERENCE . $i);
        }

        for ($i = 0; $i < self::BOOKS_COUNT_REFERENCE && $authors >= 3; $i++) {
            $book = new Book();

            /**
             * @var Author
             */
            $book->setAuthor($this->getReference(AuthorFixtures::AUTHORS_REFERENCE . rand(0, AuthorFixtures::AUTHORS_COUNT_REFERENCE - 1)));
            $authorCounts = rand(0, 3);
            $book->addAuthor($this->getReference(AuthorFixtures::AUTHORS_REFERENCE . rand(0, AuthorFixtures::AUTHORS_COUNT_REFERENCE - 1)));
            $book->setAuthors($this->pickAuthors($authors));
            $book->setSubCategory($this->getReference(SubCategoryFixtures::SUB_CATEGORIES_REFERENCE . rand(0, SubCategoryFixtures::SUB_CATEGORIES_COUNT_REFERENCE - 1)));
            $book->setIsbn($fakerFactory->isbn13);
            $book->setPageNumber(rand(100, 200));
            $book->setResume($fakerFactory->text($maxNbChars = 200));
            $book->setTitle($fakerFactory->isbn13);
            $book->setSlug(Transliterator::transliterate($book->getTitle()));

            $manager->persist($book);

            $this->addReference(self::BOOKS_REFERENCE . $i, $book);
        }

        $manager->flush();
    }

    private function pickAuthors($authors = [], $number = 3)
    {
        $pickedAuthors = [];
        for ($i = 0; $i < count($authors); $i++) {
            $index = mt_rand(0, count($authors));
            $pickedAuthors[] = $authors[$index];

            $authors = array_slice($authors, $index, 0);
        }

        return $pickedAuthors;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }
}
