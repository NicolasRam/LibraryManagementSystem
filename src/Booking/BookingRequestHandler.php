<?php

namespace App\Booking;


use App\Controller\HelperTrait;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Registry;

class BookingRequestHandler
{
    use HelperTrait;

//    private $em, $assetsDirectory, $bookingFactory, $packages, $workflows;

    /**
     * BookingRequestHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param Packages $packages
     * @internal param Package $package
     * @internal param $em
     */
    public function __construct(EntityManagerInterface $entityManager,
                                Packages $packages)
    {
        $this->em = $entityManager;
        $this->packages = $packages;
    }

    public function handle(BookingRequest $request): ?Booking
    {

        # Permet de voir les transitions possibles (Changement de Status)
        # dd($workflow->getEnabledTransitions($request));

        try {


            # Appel à notre Factory
            $booking = $this->bookingFactory->createFromBookingRequest($request);

            # Insertion en BDD
            $this->em->persist($booking);
            $this->em->flush();

            return $booking;

        } catch (LogicException $e) {

            # Transition non autorisé
            return null;

        }

    }

//    public function prepareBookingFromRequest(Booking $booking): BookingRequest
//    {
//        return BookingRequest::createFromBooking($booking, $this->packages, $this->assetsDirectory);
//    }
}