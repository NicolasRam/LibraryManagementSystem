<?php

namespace App\Twig;

use App\Entity\LikeNotification;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

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

    public function getFilters()
    {
        return [
            new TwigFilter('status', [$this, 'statusFilter'])
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
}