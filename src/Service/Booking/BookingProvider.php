<?php

namespace App\Service\Booking;


use App\Entity\Booking;
use App\Entity\PBook;
use Ovh\Exceptions\InvalidParameterException;
use PhpParser\Node\Expr\Cast\Bool_;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BookingProvider extends AbstractController
{

    /** @var LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

    }

    /**
     * @param $topNumber
     * @return array
     */
    public function topBookings($topNumber)
    {
//        try {
            $em = $this->getDoctrine()->getManager();
dump('before');
            $topBookings = $em->getRepository(Booking::class)
                ->findPbooktop($topNumber);
//            dd($topBookings);
        dump('after');
        dump($topBookings);
            //Ici on log le message envoyé ainsi que le numéro pour le suivi
//            $this->logger->info('We have contacted the logger: TOP '.$topNumber.' of pbooks requested. ');

            return $topBookings;

//        } catch (\Exception $e) {
//            echo "erreur";
//            if (null !== $this->logger) {
//                $this->logger->critical(
//                    sprintf("erreur critique"));
//            }


//        }


    }


}