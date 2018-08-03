<?php

namespace App\Entity\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* @Route("/backend")
*/
class EBookController extends Controller
{
    /**
     * @Route("/e/book", name="e_book")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Entity/Controller/EBookController.php',
        ]);
    }
}
