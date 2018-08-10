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
    public const BOOKINGS_REFERENCE = 'bookings';
    public const BOOKINGS_COUNT_REFERENCE = 10;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $start = new DateTime( '2017-01-01' );
//        $todayDate = new DateTime('now');
        $end = new DateTime('2018-01-01');
//        $interval = DateInterval::createFromDateString('1 day');
//        $period = new DatePeriod($startDate, $interval, $todayDate);

        $i = 0;
        $pbooks = [];
        while ( $this->hasReference( PBookFixtures::PBOOKS_REFERENCE . $i) ) {
            if( $this->hasReference( PBookFixtures::PBOOKS_REFERENCE . $i)) $pbooks[] = $this->getReference( PBookFixtures::PBOOKS_REFERENCE . $i++);
        }

        for ( $i = 0; $i < self::BOOKINGS_COUNT_REFERENCE; $i++ ) {
            $booking = new Booking();
            $date = $this->randomDate($start, $end);
            $startDate = $date;
            $returnDate = $date;
            $returnDate = $returnDate->modify('+15 day');
            $endDate = $date;
            $endDate = $endDate->modify('+' . mt_rand( 1, 30) . ' day');

            $booking->setPBook( $pbooks[rand(0, count($pbooks))] );
            $booking->setMember( $this->getReference( MemberFixtures::MEMBERS_REFERENCE . rand(0, MemberFixtures::MEMBERS_COUNT_REFERENCE - 1) ) );
            $booking->setStartDate( $startDate );
            $booking->setReturnDate( $returnDate );
            $booking->setEndDate( $endDate );

            $manager->persist($booking);

            $this->addReference(self::BOOKINGS_REFERENCE . $i, $booking);
        }

        $k = $i;

        for ( $i = 0; $i < self::BOOKINGS_COUNT_REFERENCE; $i++ ) {
            $booking = new Booking();
            $date = $this->randomDate($start, $end);
            $startDate = $date;
            $returnDate = $date;
            $returnDate = $returnDate->modify('+15 day');
            $endDate = $date;
            $endDate = $endDate->modify('+' . mt_rand( 1, 30) . ' day');

            $booking->setPBook( $pbooks[rand(0, count($pbooks))] );
            $booking->setMember( $this->getReference( UserFixtures::MEMBER_REFERENCE ) );
            $booking->setStartDate( $startDate );
            $booking->setReturnDate( $returnDate );
            $booking->setEndDate( $endDate );

            $manager->persist($booking);

            $this->addReference(self::BOOKINGS_REFERENCE . $k++, $booking);
        }

        $manager->flush();
    }

    /**
     * Method to generate random date between two dates
     *
     * @param DateTime $startDate
     * @param DateTime $endDate
     *
     * @return DateTime
     */
    function randomDate($startDate, $endDate)
    {
        $timestamp = mt_rand($startDate->getTimestamp(), $endDate->getTimestamp());

        $randomDate = new DateTime();
        $randomDate->setTimestamp($timestamp);

        return $randomDate;
    }


    /**
 * Get the order of this fixture
 *
 * @return integer
 */
    public function getOrder()
    {
        return 10;
    }
}