<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\BookingRepository;
use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="backend_home_index", methods="GET")
     * @param LibraryRepository $bookingRepository
     *
     * @return Response
     */
    public function index(BookingRepository $bookingRepository ): Response
    {
        dd( $bookingRepository->findLibraryLateBooking(138) );

//        return $this->render('backend/default/index.html.twig', ['libraries' => $defaultRepository->findAll()]);
    }
}
