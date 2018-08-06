<?php

namespace App\Book\Source;


use App\Controller\HelperTrait;
use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use App\Entity\User;
use App\Service\Book\YamlProvider;
use Symfony\Component\Validator\Constraints\DateTime;
use Tightenco\Collect\Support\Collection;

class YamlSource extends BookAbstractSource
{

    use HelperTrait;

    private $books;

    /**
     * YamlSource constructor.
     * @param $yamlProvider
     */
    public function __construct(YamlProvider $yamlProvider)
    {
        $this->books = new Collection($yamlProvider->getBooks());

        /*
         * Autre possibilitée :
         */
        # $this->Books = new Collection($yamlProvider->getBooks());
        # foreach ($this->books as &$book) {
        #    $book = $this->createFromArray($book);
        # }
    }

    /**
     * Permet de retourner un article sur la
     * base de son identifiant unique.
     * @param $id
     * @return Book|null
     */
    public function find($id): ?Book
    {
        $book = $this->books->firstWhere('id', $id);
        return $book == null ? null : $this->createFromArray($book);
    }

    /**
     * Retourne la liste de tous les books
     * @return iterable|null
     */
    public function findAll(): ?iterable
    {
        $books = new Collection();

        foreach ($this->books as $book) {
            $books[] = $this->createFromArray($book);
        }

        return $books;
    }

    /**
     * Retourne les 5 derniers books depuis
     * l'ensemble de nos sources...
     * @return iterable|null
     */
    public function findLastFiveBooks(): ?iterable
    {
        /* @var $books Collection */
        $books = $this->findAll();
        return $books->sortBy('id')->slice(-5);
    }

    /**
     * Retourne le nombre d'éléments de chaque source.
     * @return int
     */
    public function count(): int
    {
        return $this->books->count();
    }

    /**
     * Permet de convertir un tableau en Book.
     * @param iterable $book Un article sous forme de tableau
     * @return Book|null
     */
    protected function createFromArray(iterable $book): ?Book
    {
        //$tmp = (object) $book;

        # Construire l'objet Category
        $category = new Category();
        $category->setId($tmp->categorie['id']);
        $category->setName($tmp->categorie['name']);
        $category->setSlug($this->slugify($tmp->categorie['name']));

        # Construire l'objet Auteur
        $user = new Author();
        $user->setId($tmp->auteur['id']);
        $user->setFirstName($tmp->auteur['prenom']);
        $user->setLastName($tmp->auteur['nom']);

        $date = new \DateTime();

        $MyNewBook = new Book();

        $MyNewBook->setId($tmp->id);
        $MyNewBook->setIsbn($tmp->isbn);
        $MyNewBook->setTitle($tmp->titre);
        $MyNewBook->setSlug($this->slugify($tmp->titre));
        $MyNewBook->setResume($tmp->contenu);
        $MyNewBook->setPageNumber($tmp->nombredepage);
        $MyNewBook->setCover($tmp->featuredimage);
        $MyNewBook->setAuthor($tmp->auteur);
        $MyNewBook->setCategory($tmp->categorie);

        //On set tous les parameters
//        $tmp->set
//        $tmp->id,
//                $tmp->isbn,
//                $tmp->titre,
//                $this->slugify($tmp->titre),
//                $tmp->contenu,
//                $tmp->featuredimage,
//                $tmp->special,
//                $tmp->spotlight,
//                $date->setTimestamp($tmp->datecreation),
//                $category,
//                $user,
//                'published'
//            );

        # Construire l'objet Book
        return $MyNewBook;

    }
}