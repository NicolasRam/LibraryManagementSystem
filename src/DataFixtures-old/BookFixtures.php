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
use App\Entity\Booking;
use App\Entity\Category;
use App\Entity\EBook;
use App\Entity\Library;
use App\Entity\Member;
use App\Entity\PBook;
use App\Entity\SubCategory;
use App\Entity\User;
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

                $subcategory = $manager->getRepository(SubCategory::class)->findAll();
                //$choosenCategory = rand(0, count($category));


                $book->setAuthor($author);
                $book->setAuthors($authors);
//                $book->setCover($fakerFactory->);
                $book->setIsbn($fakerFactory->isbn13);
                $book->setPageNumber( rand(100, 200) );
                $book->setResume( $fakerFactory->text($maxNbChars = 200) );
                $book->setTitle($fakerFactory->isbn13);
                $book->setSlug($fakerFactory->isbn13);
                $book->setSubCategory($subcategory[random_int(0, count($subcategory) - 1)]);


                $manager->persist($book);

                foreach ( $libraries as $library )
                {
                    //if( 3 !== rand(0, 5) ) {
                        $monRandom = rand(0, 4);

                        for( $m = 0; $m < $monRandom; $m++ ) {

                            $pBook = new PBook();
                            $pBook->setBook($book);
                            $pBook->setLibrary($library);
                            $pBook->setStatus('waiting');
                            $aleatoire = rand(0, 4);

                            if( $aleatoire == 0 ) {
                                $pBook->setStatus('waiting');
                            }

                            if( $aleatoire == 1 ) {
                                $pBook->setStatus('inside');
                                //Ajouter des réservations des jours d'avant et d'après
                                for ($i=0;$i<=1;$i++) {

                                    $member = $manager->getRepository(Member::class)->findAll();
                                    $memberChoosed = $member[random_int(0, count($member) - 1)];


                                    $myBooking = new Booking();
                                    $myBooking->setPBook($pBook);
                                    $myBooking->setMember($memberChoosed);
                                    $timestamp = rand( strtotime("Jan 01 2018"), strtotime("Sept 01 2018") );
                                    $EndDate = date("d.m.Y", $timestamp );
                                    $EndDate = new DateTime($EndDate);
                                    $startDate = $EndDate;
                                    $EndDate->modify('+3 weeks');
                                    $myBooking->setStartDate($startDate);
                                    $myBooking->setEndDate($EndDate);
                                    $pBook->addBooking($myBooking);
                                }
                            }
                            if( $aleatoire == 2 ) {
                                $pBook->setStatus('outside');
                                //Ajouter des réservations des jours d'avant et d'après
//                                for ($i = 0; $i <= rand(0, 10); $i++) {
//
//                                    $member = $manager->getRepository(Member::class)->findAll();
//                                    $memberChoosed = $member[random_int(0, count($member) - 1)];
//
//
//                                    $myBooking = new Booking();
//                                    $myBooking->setPBook($pBook);
//                                    $myBooking->setMember($memberChoosed);
//                                    $timestamp = rand( strtotime("Jan 01 2018"), strtotime("Sept 01 2018") );
//                                    $EndDate = date("d.m.Y", $timestamp );
//                                    $EndDate = new DateTime($EndDate);
//                                    $startDate = $EndDate;
//                                    $EndDate->modify('+3 weeks');
//                                    $myBooking->setStartDate($startDate);
//                                    $myBooking->setEndDate($EndDate);
//                                    $pBook->addBooking($myBooking);
//                                }
                            }
                            if( $aleatoire == 3 ) {
                                $pBook->setStatus('not_available');
                                //Ajouter des réservations des jours d'avant et d'après
//                                for ($i = 0; $i <= rand(0, 10); $i++) {
//
//                                    $member = $manager->getRepository(Member::class)->findAll();
//                                    $memberChoosed = $member[random_int(0, count($member) - 1)];
//
//
//                                    $myBooking = new Booking();
//                                    $myBooking->setPBook($pBook);
//                                    $myBooking->setMember($memberChoosed);
//                                    $timestamp = rand( strtotime("Jan 01 2018"), strtotime("Sept 01 2018") );
//                                    $EndDate = date("d.m.Y", $timestamp );
//                                    $EndDate = new DateTime($EndDate);
//                                    $startDate = $EndDate;
//                                    $EndDate->modify('+3 weeks');
//                                    $myBooking->setStartDate($startDate);
//                                    $myBooking->setEndDate($EndDate);
//                                    $pBook->addBooking($myBooking);
//                                }
                            }
                            if( $aleatoire == 4 ) {
                                $pBook->setStatus('reserved');
                                //Ajouter plein de reservations
//                                for ($i = 0; $i <= rand(0, 10); $i++) {
//
//                                    $member = $manager->getRepository(Member::class)->findAll();
//                                    $memberChoosed = $member[random_int(0, count($member) - 1)];
//
//
//                                    $myBooking = new Booking();
//                                    $myBooking->setPBook($pBook);
//                                    $myBooking->setMember($memberChoosed);
//                                    $timestamp = rand( strtotime("Jan 01 2018"), strtotime("Sept 01 2018") );
//                                    $EndDate = date("d.m.Y", $timestamp );
//                                    $EndDate = new DateTime($EndDate);
//                                    $startDate = $EndDate;
//                                    $EndDate->modify('+3 weeks');
//                                    $myBooking->setStartDate($startDate);
//                                    $myBooking->setEndDate($EndDate);
//                                    $pBook->addBooking($myBooking);
//                                }
                            }

                            $manager->persist($pBook);

                        //}
                    }


                }

                        //En dehors de la boucle
                        $ebook = new EBook();

                        $ebook->setBook($book);

                        $manager->persist($ebook);

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