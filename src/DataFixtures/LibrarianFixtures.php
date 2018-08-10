<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Librarian;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LibrarianFixtures extends Fixture implements OrderedFixtureInterface
{
    public const LIBRARIANS_REFERENCE = 'librarian';
    public const LIBRARIANS_COUNT_REFERENCE = 10;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder ) {

        $this->encoder = $encoder;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');

        $i = 0;
        $libraries = [];
        while ( $this->hasReference( LibraryFixtures::LIBRARIES_REFERENCE . $i) ) {
            if( $this->hasReference( LibraryFixtures::LIBRARIES_REFERENCE . $i)) $libraries[] = $this->getReference( LibraryFixtures::LIBRARIES_REFERENCE . $i++);
        }

        for ( $i = 0; $i < self::LIBRARIANS_COUNT_REFERENCE; $i++ ) {
                $librarian = new Librarian();

                $librarian->setFirstName( $fakerFactory->firstName );
                $librarian->setLastName( $fakerFactory->lastName );
                $librarian->setEmail( $fakerFactory->email );
                $encoded = $this->encoder->encodePassword($librarian, '123456789');
                $librarian->setPassword( $encoded );
                $librarian->setLibrary( $libraries[rand(0, count($libraries) - 1) ] );

                $manager->persist($librarian);

            $this->addReference(self::LIBRARIANS_REFERENCE . $i, $librarian);
        }

        $librarian = new Librarian();

        $librarian->setFirstName('Nicolas');
        $librarian->setLastName( 'Ramond');
        $librarian->setEmail( 'nicolas.ramond@me.com');
        $encoded = $this->encoder->encodePassword($librarian, '123456789');
        $librarian->setPassword( $encoded );
        $librarian->setLibrary( $libraries[rand(0, count($libraries) - 1) ] );

        $manager->persist($librarian);

        $this->addReference(self::LIBRARIANS_REFERENCE . $i, $librarian);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 11;
    }
}