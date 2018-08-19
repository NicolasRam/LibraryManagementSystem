<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 18/08/2018
 * Time: 18:27
 */

namespace App\Controller\API;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookController
 * @package App\Controller\API
 *
 * @Route("/api/books")
 */
class BookController
{
    /**
     * Count action
     *
     * @Route(
     *     name="api_book_count",
     *     path="/count",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Book::class,
     *         "_api_item_operation_name"="count"
     *     }
     * )
     *
     * @param BookRepository $bookRepository
     * @return JsonResponse
     *
     */
    public function count( BookRepository $bookRepository )
    {
        $booksCount = $bookRepository->count([]);

        return new JsonResponse( [ 'booksCount' => $booksCount ] );
    }


    public function __construct( BookRepository $bookRepository )
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @Route(
     *     name="api_book_best_sellers",
     *     path="/best-sellers",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Book::class,
     *         "_api_collection_operation_name"="best_sellers"
     *     }
     * )
     *
     * @return BookRepository
     */
    public function __invoke()
    {
        # Ta logique

        return $this->bookRepository->findBestSellers(5);
    }
}