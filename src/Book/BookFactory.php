<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 29/06/2018
 * Time: 11:23
 */

namespace App\Book;

use App\Entity\Book;

class BookFactory
{
    public function createFromBookRequest(BookRequest $request): Book
    {
        return new Book(
            $request->getId(),
            $request->getTitle(),
            $request->getSlug(),
            $request->getResume(),
            $request->getFeaturedImage(),
            $request->getCategory(),
            $request->getAuthor(),
            $request->getStatus()
        );
    }
}
