<?php

namespace App\Entity\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* @Route("/backend")
*/
class FormatController extends Controller
{
    /**
     * @Route("/format", name="format")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Entity/Controller/FormatController.php',
        ]);
    }
}
