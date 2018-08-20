<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27
 */

namespace App\Controller\API;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthorController
 * @package App\Controller\API
 *
 * @Route("/api/authors")
 */
class AuthorController extends Controller
{
    private $authorRepository;

    public function __construct( AuthorRepository $authorRepository )
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @Route(
     *     "/count",
     *     name="api_author_count",
     *     defaults={
     *          "#_api_resource_class"=Author::class,
     *          "_api_item_operation_name"="count",
     *          "_api_receive"=false
     *      }
     * )
     * @return JsonResponse
     */
    public function count()
    {
        $authorsCount = $this->authorRepository->count([]);

        return new JsonResponse(['authorsCount' => $authorsCount]);
    }


    /**
     * @Route(
     *     name="api_author_most_populars",
     *     path="/most-populars",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Author::class,
     *         "_api_collection_operation_name"="most_populars"
     *     }
     * )
     *
     * @return array
     */
    public function newReleases()
    {
        return $this->authorRepository->findBy([],[],10);
    }
}