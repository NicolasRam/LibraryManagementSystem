<?php

namespace App\Booking;


use App\Entity\Booking;
use App\Entity\Member;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class BookingRequest
{

    private $id;

    /**
     * @Assert\NotBlank(message="asserts.booking.pbook.notblank")
     */
    private $pBook;

    /**
     * @Assert\NotBlank(message="asserts.booking.member.notblank")
     */
    private $member;

    /**
     * @Assert\NotBlank(message="asserts.booking.startDate.notblank")
     */
    private $startDate;

    /**
     * @Assert\NotBlank(message="asserts.booking.endDate.notblank")
     */
    private $endDate;

    /**
     * @Assert\NotBlank(message="asserts.booking.returnDate.notblank")
     */
    private $returnDate;

    /**
     * Créer un BookingRequest depuis un Booking de Entity
     * @param Booking $booking
     * @param Packages $packages
     * @return BookingRequest
     * @internal param Package|Packages $package
     * @internal param Package $package
     */
    public static function createFromBooking(Booking $booking, Packages $packages): self
    {
        $ar = new self($booking->getPBook());
        $ar->id = $booking->getId();
        $ar->member = $booking->getMember();
        $ar->startDate = $booking->getStartDate();
        $ar->endDate = $booking->getEndDate();
        $ar->returnDate = $booking->getReturnDate();

        return $ar;
    }
}