<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\HttpFoundation\File\File;

class ImageFixtures extends Fixture implements OrderedFixtureInterface
{
    public const IMAGES_REFERENCE = 'images';
    public const IMAGES_COUNT_REFERENCE = 10;

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


        for ($i = 0; $i < self::IMAGES_COUNT_REFERENCE; $i++) {
            $image = new Image();

            $image->setName( $fakerFactory->name );
            $image->setPath(
                $fakerFactory->image
                (
                '/tmp',
                '../public/upload/images',
                true
                )
            );
            if( isset(explode('.', $image->getPath(), 1)[1]) ) $image->setExtension( explode('.', $image->getPath(), 1)[1] );

            $manager->persist($image);

            $this->addReference( self::IMAGES_REFERENCE . $i, $image );
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
        return 7;
    }
}