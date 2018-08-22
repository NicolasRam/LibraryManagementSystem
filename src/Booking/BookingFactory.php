<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 29/06/2018
 * Time: 11:23.
 */

namespace App\Booking;

use App\Entity\Booking;

class BookingFactory
{
    public function createFromBookingRequest(BookingRequest $request): Booking
    {
        $booking = new Booking();
        $booking->setPBook($request->getPBook());
        $booking->setMember($request->getMember());
        $booking->setStartDate($request->getStartDate());
        $booking->setEndDate($request->getEndDate());

        return $booking;
    }
}
