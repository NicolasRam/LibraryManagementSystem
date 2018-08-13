<?php

namespace App\Twig;

use App\Entity\LikeNotification;
use App\Entity\PBook;
use DateTime;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var string
     */
    private $locale;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('filter_pbooks', [$this, 'filterPBooks']),
        ];
    }

    public function getFilters()
    {
        return [
            new TwigFilter('status', [$this, 'statusFilter']),
            new TwigFilter('time_elapsed_string', [$this, 'timeElapsedString']),
        ];
    }

    public function getGlobals()
    {
        return [
            'locale' => $this->locale
        ];
    }

    public function statusFilter($status)
    {
        return '<span>' . $status . '</span>';
    }

    public function getTests()
    {
        return [
            new \Twig_SimpleTest(
                'like',
                function ($obj) { return $obj instanceof LikeNotification;}
                )
        ];
    }

    /**
     * @param $pbooks
     */
    function filterPBooks($pbooks) : array {
        $pbookInside = [];
        $pbookOutside = [];
        $pbookReserved = [];
        $pbookNotAvailable = [];

        /**
         * @var PBook $pbook
         */
        foreach ($pbooks as $pbook) {
            if (in_array(PBook::STATUS_INSIDE, $pbook->getStatus())){
                $pbookInsides[] = $pbook;
            }

            if (in_array(PBook::STATUS_OUTSIDE, $pbook->getStatus())){
                $pbookOutside[] = $pbook;
            }

            if (in_array(PBook::STATUS_RESERVED, $pbook->getStatus())){
                $pbookReserved[] = $pbook;
            }

            if (in_array(PBook::STATUS_NOT_AVAILABLE, $pbook->getStatus())){
                $pbookNotAvailable[] = $pbook;
            }
        }

        return [
            'insides_pbooks' => $pbookInside,
            'outside_pbooks' => $pbookOutside,
            'reserved_pbooks' => $pbookReserved,
            'not_available_pbooks' => $pbookNotAvailable,
        ];
    }

    function timeElapsedString($datetime, $full = false) {
        $now = new DateTime;
//        $ago = new DateTime($datetime);
        $ago = $datetime;
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}