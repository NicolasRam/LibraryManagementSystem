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
use App\Mailer\Mailer;
use DateInterval;
use DatePeriod;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use function GuzzleHttp\Psr7\modify_request;
use Symfony\Component\Workflow\Registry;

class BookingFixtures extends Fixture implements OrderedFixtureInterface
{
    public const BOOKINGS_REFERENCE = 'bookings';
    /**
     * @var Mailer
     */
    private $mailer;

//    public const BOOKINGS_COUNT_REFERENCE = 10;

    public function __construct( Mailer $mailer ) {

        $this->mailer = $mailer;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $registry = new Registry();

        //        new DateTime( '2017-01-01' );
        $todayDate = new DateTime('now');
        $start = $todayDate;
        $start->modify('-45 day');
        $end = new DateTime('now');
        $end->modify('-15 day');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);

        $i = 0;
        $pbooks = [];
        while ( $this->hasReference( PBookFixtures::PBOOKS_REFERENCE . $i) ) {
            if( $this->hasReference( PBookFixtures::PBOOKS_REFERENCE . $i)) $pbooks[] = $this->getReference( PBookFixtures::PBOOKS_REFERENCE . $i++);
        }

        $i = 0;

        /**
         * @var DateTime $day
         */
        foreach ($period as $day) {
            $k = 0;
            while ( $this->hasReference( self::BOOKINGS_REFERENCE . $k) ) {
                if( $this->hasReference( self::BOOKINGS_REFERENCE . $k && 1 === mt_rand(0, 2) ) ) {
                    /**
                     * @var Booking $booking
                     */
                    $booking = $this->getReference( self::BOOKINGS_REFERENCE . $k++);
                    $pbook = $booking->getPBook();

                    $workflow = $registry->get($pbook);

                    switch ( true ) {
                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'rent') :
                            $workflow->apply($pbook, 'rent');
                            $manager->persist($pbook);
                        break;

                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'inside_reserv') :
                            $workflow->apply($pbook, 'inside_reserv');

                            $manager->persist($pbook);
                        break;

                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'rent_reserv') :
                            $workflow->apply($pbook, 'rent_reserv');

                            $manager->persist($pbook);
                        break;

                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'return') :
                            $workflow->apply($pbook, 'return');
                            $booking->setReturnDate( $day );

                            $manager->persist($pbook);
                        break;

                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'return_reserv') :
                            $workflow->apply($pbook, 'return_reserv');
                            $booking->setReturnDate( $day );

                            $manager->persist($pbook);
                        break;

                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'return_ko') :
                            $workflow->apply($pbook, 'return_ko');
                            $booking->setReturnDate( $day );

                            $manager->persist($pbook);
                        break;

                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'return_res_ko') :
                            $workflow->apply($pbook, 'return_res_ko');
                            $booking->setReturnDate( $day );

                            $manager->persist($pbook);
                        break;

                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'ret_no_res_ins') :
                            $workflow->apply($pbook, 'ret_no_res_ins');
                            $booking->setReturnDate( $day );

                            $manager->persist($pbook);
                        break;

                        case 1 === mt_rand(0, 2) && $workflow->can($pbook, 'repaired') :
                            $workflow->apply($pbook, 'ret_no_res_ins');

                            $manager->persist($pbook);
                        break;
                    }

                    if(  $day > $booking->getEndDate() ) {
                        $this->mailer->sendLateBookingNotification($booking);
                    }
                }
            }

            foreach ( $pbooks as $pbook ) {
                if( 1 === mt_rand(0, 2) ) {
                    $booking = new Booking();
                    $date = $day;
                    $startDate = $date;
                    $returnDate = $date;
                    $returnDate = $returnDate->modify('+15 day');
                    $endDate = $date;
                    $endDate = $endDate->modify('+' . mt_rand( 1, 14) . ' day');

                    $booking->setPBook( $pbook );
                    $booking->setMember( $this->getReference( MemberFixtures::MEMBERS_REFERENCE . rand(0, MemberFixtures::MEMBERS_COUNT_REFERENCE - 1) ) );
                    $booking->setStartDate( $startDate );
//                    $booking->setReturnDate( $returnDate );
                    $booking->setEndDate( $endDate );

                    $manager->persist($booking);

                    $this->addReference(self::BOOKINGS_REFERENCE . $i++, $booking);
                }
            }
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