<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Librarian;
use App\Entity\Member;
use App\Entity\PBook;
use App\Entity\User;
use App\Service\Provider\LibrarianProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend")
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="backend_home", methods="GET")
     * @Route("/", name="backend_home_index", methods="GET")
     * @param LibrarianProvider $librarianProvider
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(LibrarianProvider $librarianProvider)
    {
        $user = $this->getUser();
        $response = new Response();

        switch (true) {
            case $this->isGranted([User::ROLE_SUPER_ADMIN], $user):
                $response = $this->superAdminIndex();
                break;

            case $this->isGranted([User::ROLE_ADMIN], $user):
                $response = $this->adminIndex();
                break;

            case $this->isGranted([User::ROLE_LIBRARIAN], $user):
                $response = $this->librarianIndex($librarianProvider);
                break;
        }

        return $response;
    }

    /**
     * @return Response
     */
    private function superAdminIndex() : Response
    {
        return $this->render(
            'backend/home/super_admin.html.twig',
            []
        );
    }

    /**
     * @return Response
     */
    private function adminIndex() : Response
    {
        return $this->render(
            'backend/home/admin.html.twig',
            []
        );
    }

    /**
     * @param LibrarianProvider $librarianProvider
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function librarianIndex(LibrarianProvider $librarianProvider) : Response
    {
        /**
         * @var Librarian $librarian
         */
        $librarian = $this->getUser();
        $library = $librarian->getLibrary();

        return $this->render(
            'backend/home/librarian.html.twig',
            [
                'firebaseBooks' => $librarianProvider->getGetBooksFromFirebase(),
                'librarian' => $librarianProvider->getLibrarian(),
                'library' => $librarianProvider->getLibrary(),

                'books' => $librarianProvider->getBooks($library),
                'bookCount' => count($librarianProvider->getBooks($library)),

                'pbooks' => $this->getDoctrine()->getRepository(PBook::class)->findAll(),
                'mostRentedPBooks' => $this->getDoctrine()->getRepository(PBook::class)->findMostRentedByLibrary($library->getId()),

                'bookings' => $this->getDoctrine()->getRepository(Booking::class)->findByLibrary($library->getId()),
                'lateBookings' => $this->getDoctrine()->getRepository(Booking::class)->findLateByLibrary($library->getId()),
                'lateBookingCount' => $this->getDoctrine()->getRepository(Booking::class)->countLateByLibrary($library->getId()),
                'bookingCount' => $this->getDoctrine()->getRepository(Booking::class)->countByLibrary($library->getId()),

                'lateMembers' => $this->getDoctrine()->getRepository(Member::class)->findLateByLibrary($library->getId()),
            ]
        );
    }
}
