<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Library;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LibraryFixtures extends Fixture implements OrderedFixtureInterface
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

        for ( $i = 0; $i < 10; $i++ )
        {
            $library = new Library();

            $library->setName( $fakerFactory->company );
            $library->setEmail( $fakerFactory->email );
            $library->setAddress( $fakerFactory->address );
            $library->setClosingTime( new DateTime() );
            $library->setOpeningDate( new DateTime() );
            $library->setPhone( $fakerFactory->phoneNumber );

            $manager->persist($library);
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
        return 2;
    }
}