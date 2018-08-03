<?php

namespace App\Controller;

use App\Entity\PBook;
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
     * @Route("/", name="backend_home", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('backend/home/index.html.twig', []);
    }

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
    
}
