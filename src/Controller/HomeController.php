<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Library;
use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="backend_home", methods="GET")
     */
    public function index(): Response
    {
        $libraries = $this->getDoctrine()->getManager()->getRepository(Library::class)->findAll();
        $library = $this->getUser()->getLibrary();

        $books = [];
        $latepBooks = [];
        /*
         * @var PBook
         */
        foreach ($library->getPBooks() as $pbook) {
            $books[] = $pbook->getBook();
        }

        $datePlusOneDay = new DateTime('NOW');
        $datePlusOneDay->add(new DateInterval('P1D'));
//        echo $date->format('Y-m-d') . "\n";

        foreach ($library->getPBooks() as $pbook) {
            foreach ($pbook->getBookings() as $booking)
                //dd($booking);
            if (
                (($booking->getEndDate()) < $datePlusOneDay) && (($booking->getReturnDate()) === NULL)
        )
            {
            $latepBooks[] = $booking;
            }
        }

        //We cope topbooking
        $topbookings = $this->getDoctrine()->getRepository(Booking::class)->findPbooktop(10);

        return $this->render('backend/home/index.html.twig', [
            'books' => $books,
            'libraries' => $libraries,
            'latepBooks' => $latepBooks,
            'topbookings' => $topbookings
        ]);
    }
}
