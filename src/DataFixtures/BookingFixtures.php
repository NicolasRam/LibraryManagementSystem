<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Booking;
use App\Entity\PBook;
use App\Entity\Member;
use DateInterval;
use DatePeriod;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookingFixtures extends Fixture implements OrderedFixtureInterface
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
        $members = $manager->getRepository(Member::class)->findAll();
        $books = $manager->getRepository(Book::class)->findAll();
        $pbooks = $manager->getRepository(PBook::class)->findAll();

        $startDate = new DateTime( '2018-06-06' );
        $todayDate = new DateTime('now');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($startDate, $interval, $todayDate);

        foreach ($period as $day) {
            $booking = new Booking();

            $booking->setPBook( $pbooks[ rand(0, count($pbooks) - 1 ) ] );
            $booking->setMember( $members[ rand(0, count($members) - 1 ) ] );
            $booking->setStartDate( $day );
            $booking->setReturnDate( $day );
            $booking->setEndDate( $day );

             $manager->persist($booking);
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
        return 4;
    }
}