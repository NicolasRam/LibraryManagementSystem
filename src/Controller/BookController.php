<?php

namespace App\Controller;

use App\Book\BookCatalogue;
use App\Entity\Book;
use App\Entity\PBook;
use App\Service\Book\YamlProvider;
use Swift_Mailer;
use Symfony\Component\Workflow\Registry;
use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/backend/book")
 */
class BookController extends Controller
{
    /**
     * @Route("/", name="backend_book_index", methods="GET")
     * @param Swift_Mailer $mailer
     */
//    public function index(\Swift_Mailer $mailer)
//    {
//
//        $message = (new \Swift_Message('Hello Email'))
//            ->setFrom('send@librarymanagementsystem.com')
//            ->setTo('nicolas.ramond@me.com')
//            ->setBody(
//                $this->renderView(
//                // templates/emails/registration.html.twig
//                    'emails/registration.html.twig',
//                    array('name' => 'nicolas')
//                ),
//                'text/html'
//            )
//
//             /* If you also want to include a plaintext version of the message
//            ->addPart(
//                $this->renderView(
//                    'emails/registration.txt.twig',
//                    array('name' => $name)
//                ),
//                'text/plain'
//            )
//            */
//        ;
//
//        $mailer->send($message);
//
////        $this->redirectToRoute("backend_home");
//        return $this->render('backend/home/index.html.twig', []);
//    }

    /**
     * @Route("/", name="backend_book_index", methods="GET")
     * @param YamlProvider $yamlProvider
     * @param BookCatalogue $catalogue
     * @return Response
     */
//    public function index(YamlProvider $yamlProvider, BookCatalogue $catalogue)
    public function index(BookCatalogue $catalogue)
    {

        $books = $catalogue->findAll();

        return $this->render('backend/book/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/{id}", name="backend_book_show", methods="GET")
     * @param Book $book
     * @return Response
     */
    public function show(Book $book): Response
    {
        $pbook = $book->getPBooks();

        $count = count($pbook);


        return $this->render('backend/book/show.html.twig', [
            'book' => $book, 'pbook' => $pbook, 'count' => $count
        ]);
    }


    /**
     * @Route("/{id}", name="backend_book_edit", methods="GET")
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
     * @Route("/{id}", name="backend_book_delete", methods="DELETE")
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($book);
            $em->flush();
        }

        return $this->redirectToRoute('backend_librarian_index');
    }

}