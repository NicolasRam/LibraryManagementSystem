<?php

namespace App\Controller;

use App\Entity\PBook;
use App\Form\PBookType;
use App\Repository\PBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend/pbook")
 */
class PBookController extends Controller
{
    /**
     * @Route("/", name="backend_pbook_index", methods="GET")
     */
    public function index(PBookRepository $pbookRepository): Response
    {
        return $this->render('backend/pbook/index.html.twig', ['pbooks' => $pbookRepository->findAll()]);
    }

    /**
     * @Route("/new", name="pbook_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $pbook = new PBook();
        $form = $this->createForm(PBookType::class, $pbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pbook);
            $em->flush();

            return $this->redirectToRoute('backend_pbook_index');
        }

        return $this->render('backend/pbook/new.html.twig', [
            'pbook' => $pbook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pbook_show", methods="GET")
     */
    public function show(PBook $pbook): Response
    {
        return $this->render('backend/pbook/show.html.twig', ['pbook' => $pbook]);
    }

    /**
     * @Route("/{id}/edit", name="pbook_edit", methods="GET|POST")
     */
    public function edit(Request $request, PBook $pbook): Response
    {
        $form = $this->createForm(PBookType::class, $pbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pbook_edit', ['id' => $pbook->getId()]);
        }

        return $this->render('backend/pbook/edit.html.twig', [
            'pbook' => $pbook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pbook_delete", methods="DELETE")
     */
    public function delete(Request $request, PBook $pbook): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pbook->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pbook);
            $em->flush();
        }

        return $this->redirectToRoute('backend_pbook_index');
    }

    /**
     * @Route("/api/cards/generate", name="card_generate", defaults={
     *   "#_api_resource_class"=Card::class,
     *   "_api_item_operation_name"="generate",
     *   "_api_receive"=false
     * })
     */
    public function generate()
    {
        $user = ['user' => $this->getUser()->getUsername()];

        $card = new Card();
        $card->setCode(rand(12, 148));

        $this->getDoctrine()->getManager()->persist($card);
        $this->getDoctrine()->getManager()->flush();

        $responseCard = [
            'id' => $card->getId(),
            'code' => $card->getCode(),
        ];

        return new JsonResponse($responseCard);
    }
}
