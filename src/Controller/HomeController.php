<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Librarian;
use App\Entity\Library;
use App\Entity\SuperAdmin;
use App\Entity\User;
use App\Repository\BookingRepository;
use App\Repository\BookRepository;
use App\Repository\LibraryRepository;
use App\Repository\MemberRepository;
use App\Repository\PBookRepository;
use App\Service\Provider\LibrarianProvider;
use Doctrine\ORM\NonUniqueResultException;
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
     * @param LibraryRepository $libraryRepository
     * @param BookRepository $bookRepository
     * @param PBookRepository $pbookRepository
     *
     * @param BookingRepository $bookingRepository
     *
     * @param MemberRepository $memberRepository
     * @param LibrarianProvider $librarianProvider
     * @return Response
     * @throws NonUniqueResultException
     */
    public function index(
        LibraryRepository $libraryRepository
        , BookRepository $bookRepository
        , PBookRepository $pbookRepository
        , BookingRepository $bookingRepository
        , MemberRepository $memberRepository
        , LibrarianProvider $librarianProvider
    ): Response
    {
        $user = $this->getUser();
        $view = 'backend/home/index.html.twig';
        $parameters = [];
        $doctrine = $this->getDoctrine();
        $library = new Library();

        switch ( TRUE ) {
            case $this->isGranted([User::ROLE_SUPER_ADMIN], $user) :
                $view = 'backend/home/super_admin.html.twig';
                /**
                 * @var SuperAdmin $admin
                 */
                $super_admin = $user;

                break;

            case $this->isGranted( [User::ROLE_ADMIN], $user ) :
                $view = 'backend/home/admin.html.twig';

                /**
                 * @var Admin $admin
                 */
                $admin = $user;
                break;

            case $this->isGranted( [User::ROLE_LIBRARIAN], $user ) :
                $view = 'backend/home/librarian.html.twig';

                /**
                 * @var Librarian $librarian
                 */
                $librarian = $user;

                $library = $libraryRepository->find( $librarian->getLibrary()->getId() );

                $pbooks = $pbookRepository->findBy( ['library' => $library] );
                $mostRentedPBooks = $pbookRepository->findMostRentedByLibrary( $library->getId() );

                $bookings = $bookingRepository->findByLibrary( $library->getId() );
                $lateBookings = $bookingRepository->findLateByLibrary( $library->getId() );
                $lateBookingCount = $bookingRepository->countLateByLibrary( $library->getId() );
                $bookingCount = $bookingRepository->countByLibrary( $library->getId() );

                $bookCount = $bookRepository->countByLibrary( $library->getId() );
                $books = $bookRepository->findByLibrary($library->getId());

                $lateMembers = $memberRepository->findLateByLibrary( $library->getId() );

                $parameters = [
                    'librarian' => $librarian,
                    'library' => $library,

                    'books' => $books,
                    'bookCount' => $bookCount,

                    'pbooks' => $pbooks,
                    'mostRentedPBooks' => $mostRentedPBooks,

                    'bookings' => $bookings,
                    'lateBookings' => $lateBookings,
                    'lateBookingCount' => $lateBookingCount,
                    'bookingCount' => $bookingCount,

                    'lateMembers' => $lateMembers,
                ];
                break;
        }

        return $this->render(
            'backend/home/librarian.html.twig',
            [
                'librarian' => $librarianProvider->getLibrarian(),
                'library' => $librarianProvider->getLibrary(),

                'books' => $librarianProvider->getBooks($library),
                'bookCount' => $librarianProvider->getBooks($library),

                'pbooks' => $pbooks,
                'mostRentedPBooks' => $mostRentedPBooks,

                'bookings' => $bookings,
                'lateBookings' => $lateBookings,
                'lateBookingCount' => $lateBookingCount,
                'bookingCount' => $bookingCount,

                'lateMembers' => $lateMembers,
            ]
        );

//        return $this->render( $view, $parameters );
    }
}
