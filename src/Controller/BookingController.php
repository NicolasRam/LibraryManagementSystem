<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\PBook;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend/booking")
 */
class BookingController extends Controller
{
    /**
     * @Route("/", name="backend_booking_index", methods="GET")
     * @param BookingRepository $bookingRepository
     * @return Response
     */
    public function index(BookingRepository $bookingRepository): Response
    {
        return $this->render('backend/booking/index.html.twig', ['bookings' => $bookingRepository->findAll()]);
    }


    /**
     * @Route("/rent/{id}/", name="backend_booking_rent", methods="GET|POST|DELETE")
     * @param Request $request
     * @param PBook $pbook
     * @return Response
     */
    public function rent(Request $request, PBook $pbook): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

        //TO-DO: fournir le pbook au form

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_booking_rent', ['id' => $booking->getId()]);
        }

        return $this->render('backend/booking/rent.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="booking_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('backend_booking_index');
        }

        return $this->render('backend/booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="booking_show", methods="GET")
     */
    public function show(Booking $booking): Response
    {
        return $this->render('backend/booking/show.html.twig', ['booking' => $booking]);
    }

    /**
     * @Route("/{id}/edit", name="booking_edit", methods="GET|POST")
     */
    public function edit(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('booking_edit', ['id' => $booking->getId()]);
        }

        return $this->render('backend/booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="booking_delete", methods="DELETE")
     */
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($booking);
            $em->flush();
        }

        return $this->redirectToRoute('backend_booking_index');
    }
}
