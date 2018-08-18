<?php

namespace App\Controller;

use App\Entity\Library;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="backend_home", methods="GET")
     */
    public function index(): Response
    {
        $libraries = $this->getDoctrine()->getManager()->getRepository(Library::class)->findAll();
        $library = $this->getUser()->getLibrary();
        $books = [];

        /*
         * @var PBook
         */
        foreach ($library->getPBooks() as $pbook) {
            $books[] = $pbook->getBook();
        }

        return $this->render('backend/home/index.html.twig', [
            'books' => $books,
            'libraries' => $libraries
        ]);
    }
}
