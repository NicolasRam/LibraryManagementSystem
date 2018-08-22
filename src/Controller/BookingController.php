<?php

namespace App\Controller;

use App\Booking\BookingRequest;
use App\Booking\BookingRequestHandler;
use App\Entity\Booking;
use App\Entity\PBook;
use App\Form\BookingRequestType;
use App\Repository\BookingRepository;
use App\Service\Member\MemberProvider;
use App\Service\Sms\SmsBuilder;
use App\Service\Sms\SmsProvider;
use App\Workflow\WorkflowProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

/**
 * @Route("/booking")
 */
class BookingController extends Controller
{
    /**
     * @var MemberProvider
     */
    private $memberProvider;

    /**
     * @Route("/", name="booking_index", methods="GET")
     *
     * @param BookingRepository $bookingRepository
     *
     * @return Response
     */
    public function index(BookingRepository $bookingRepository): Response
    {
        return $this->render('booking/index.html.twig', ['bookings' => $bookingRepository->findAll()]);
    }

    /**
     * @Route("/rent/{id}/", name="booking_rent", methods="GET|POST|DELETE")
     *
     * @param Request               $request
     * @param BookingRequestHandler $bookingRequestHandler
     * @param PBook                 $pbook
     * @param MemberProvider        $memberProvider
     * @param SmsProvider           $smsProvider
     * @param Registry              $workflows
     * @param WorkflowProvider      $workflowProvider
     *
     * @return Response
     *
     * @throws \Ovh\Exceptions\InvalidParameterException
     */
    public function rent(
        Request $request,
        BookingRequestHandler $bookingRequestHandler,
        PBook $pbook,
        MemberProvider $memberProvider,
        Registry $workflows,
        WorkflowProvider $workflowProvider
    ): Response {
        $bookingRequest = new BookingRequest($pbook);

        $form = $this->createForm(BookingRequestType::class, $bookingRequest);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //On vérifie que le membre peut souscrire à une nouvelle reservation
            $verifyIfBookingValid = $memberProvider->verifyIfBookingCanBeValid($bookingRequest->getMember());

            if (true == $verifyIfBookingValid) {
                $this->getDoctrine()->getManager()->flush();

                $booking = $bookingRequestHandler->handle($bookingRequest);

                $workflowProvider->changingState($workflows, $pbook, 'rent');

                $this->addFlash('notice', 'L\'emprunt est effectif.');

                $smsbuilder = new SmsBuilder($bookingRequest, 'rent');

//                $smsProvider->sendMessage($phoneMember, $message);

                return $this->redirectToRoute('booking_rent', ['id' => $pbook->getId()]);
            } else {
                $this->addFlash('error', 'Ce membre a déjà 3 livres en location');
            }
        }

        return $this->render('booking/rent.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="booking_new", methods="GET|POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingRequestType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('booking_index');
        }

        return $this->render('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="booking_show", methods="GET")
     */
    public function show(Booking $booking): Response
    {
        return $this->render('booking/show.html.twig', ['booking' => $booking]);
    }

    /**
     * @Route("/{id}/edit", name="booking_edit", methods="GET|POST")
     */
    public function edit(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingRequestType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('booking_edit', ['id' => $booking->getId()]);
        }

        return $this->render('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="booking_delete", methods="DELETE")
     *
     * @param Request $request
     * @param Booking $booking
     *
     * @return Response
     */
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($booking);
            $em->flush();
        }

        return $this->redirectToRoute('booking_index');
    }
}
