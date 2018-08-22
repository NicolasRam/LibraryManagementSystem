<?php

namespace App\Controller;

use App\Book\BookCatalogue;
use App\Entity\Book;
use App\Entity\PBook;
use Symfony\Component\Workflow\Registry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book")
 */
class BookController extends Controller
{
    /**
     * @Route("/", name="book_index", methods="GET")
     *
     * @return Response
     */
    public function index(BookCatalogue $catalogue)
    {
        $library = $this->getUser()->getLibrary();

        $books = [];

        /*
         * @var PBook
         */
        foreach ($library->getPBooks() as $pbook) {
            $books[] = $pbook->getBook();
        }

        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/{id}/show", name="book_show", methods="GET")
     *
     * @param Book $book
     *
     * @return Response
     */
    public function show(Book $book): Response
    {
        $pbook = $book->getPBooks();

        $count = count($pbook);

        return $this->render('book/show.html.twig', [
            'book' => $book, 'pbook' => $pbook, 'count' => $count,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods="GET")
     *
     * @param Registry $workflows
     */
    public function edit(Registry $workflows)
    {
        $pbook = new PBook();
        $workflow = $workflows->get($pbook);

        // if there are multiple workflows for the same class,
        // pass the workflow name as the second argument
        // $workflow = $workflows->get($pbook, 'blog_publishing');

        // you can also get all workflows associated with an object, which is useful
        // for example to show the status of all those workflows in a backend
        $pbookWorkflows = $workflows->all($pbook);

//        $workflow->can($pbook, 'publish'); // False
//        $workflow->can($pbook, 'to_review'); // True

        // Update the currentState on the post
        try {
            $workflow->apply($pbook, 'to_review');
        } catch (TransitionException $exception) {
            // ... if the transition is not allowed
        }

        // See all the available transitions for the post in the current state
        $transitions = $workflow->getEnabledTransitions($pbook);
    }

    /**
     * @Route("/{id}/delete", name="book_delete", methods="DELETE")
     *
     * @param Request $request
     * @param Book    $book
     *
     * @return Response
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($book);
            $em->flush();
        }

        return $this->redirectToRoute('librarian_index');
    }
}
