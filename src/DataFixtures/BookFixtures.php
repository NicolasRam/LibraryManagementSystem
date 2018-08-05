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
use App\Entity\EBook;
use App\Entity\Library;
use App\Entity\PBook;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BookFixtures extends Fixture implements OrderedFixtureInterface
{
    public function __construct() {
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');
        $libraries = $manager->getRepository(Library::class)->findAll();

        for ( $i = 0; $i < 100; $i++ )
        {
            $author = new Author();

            $author->setFirstName( $fakerFactory->firstName );
            $author->setLastName( $fakerFactory->lastName );
            $author->setBiography( $fakerFactory->text($maxNbChars = 200) );

            $manager->persist( $author );

            $authors = [];

            for ( $k = 0; $k < rand(0, 3); $k++ ) {
                $authors[$i] = new Author();

                $authors[$i]->setFirstName( $fakerFactory->firstName );
                $authors[$i]->setLastName( $fakerFactory->lastName );
                $authors[$i]->setBiography( $fakerFactory->text($maxNbChars = 200) );

                $manager->persist( $authors[$i] );
            }

            for ( $k = 0; $k < rand(1, 1); $k++ ) {
                $book = new Book();

                $book->setAuthor($author);
                $book->setAuthors($authors);
//                $book->setCover($fakerFactory->);
                $book->setIsbn($fakerFactory->isbn13);
                $book->setPageNumber( rand(100, 200) );
                $book->setResume( $fakerFactory->text($maxNbChars = 200) );
                $book->setTitle($fakerFactory->isbn13);

                $manager->persist($book);

                foreach ( $libraries as $library )
                {
                    if( 3 !== rand(0, 5) ) {
                        for( $m = 0; $m < rand(1, 10); $m++ ) {
                            $pBook = new PBook();

                            $pBook->setBook($book);
                            $pBook->setLibrary($library);
                            $pBook->setStatus('available');

                            $manager->persist($pBook);
                        }
                    }

                    if( 2 !== rand(0, 5) ) {
                        $eBook = new EBook();

                        $eBook->setBook($book);

                        $manager->persist($eBook);
                    }
                }
            }
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}