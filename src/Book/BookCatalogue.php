<?php
namespace App\Book;

use App\Book\Source\BookAbstractSource;
use App\Entity\Book;
use Tightenco\Collect\Support\Collection;

/**
 * Class BookCatalogue
 *
 * @package App\Book
 */
class BookCatalogue implements BookCatalogueInterface
{
    /**
     * Sources
     *
     * @var BookAbstractSource[] $sources
     */
    private $sources;

    /**
     * Add a source to the catalogue
     *
     * @param BookAbstractSource $source
     *
     * @return void
     */
    public function addSource(BookAbstractSource $source): void
    {
        // TODO: Vérifier que la source n'est pas déjà présente.
        $this->sources[] = $source;
    }

    /**
     * Set all sources
     *
     * @param iterable $sources
     *
     * @return void
     */
    public function setSources(iterable $sources): void
    {
        $this->sources = $sources;
    }

    /**
     * Get all sources from catalogue
     *
     * @return iterable
     */
    public function getSources(): iterable
    {
        return $this->sources;
    }

    /**
     * Find à book from all sources by his id
     *
     * @param $id
     *
     * @return Book|null
     */
    public function find($id): ?Book
    {
        $books = new Collection();

        // Je parcours mes sources à la recherche de mon livre
        /* @var $source BookAbstractSource */
        foreach ($this->sources as $source) {
            //dd($source);
            // J'appel la fonction find() de chaque source
            $book = $source->find($id);

            /*
             * Si ma source ne me renvoi pas null,
             * alors je l'ajoute à ma liste d'books
             */
            if (null !== $book) {
                $books[] = $book;
            }

            // Vérification s'il y a des doublons
            //if($books->count() > 1) {
            //    throw new DuplicateCatalogueBookException(sprintf(
            //       'Return value of %s cannot return more than one record on line %s',
            //       get_class($this).'::'.__FUNCTION__.'()',__LINE__
            //    ));
            //}
        }

        // Retourne le livre de la dernière source
        return $books->pop();
    }

    /**
     * Retourne la liste de tous les books.
     *
     * @return iterable|null
     */
    public function findAll(): ?iterable
    {
        return $this->iterateOverSources('findAll');
//            ->sortBy('createdDate');
    }

    /**
     * Retourne les 5 derniers books depuis
     * l'ensemble de nos sources...
     *
     * @return iterable|null
     */
    public function findLastFiveBooks(): ?iterable
    {
        /*
         * TODO : Voir le Tri par date
         */
        return $this->iterateOverSources('findLastFiveBooks')
            ->slice(-5);
    }

    /**
     * Retourne le nombre d'éléments de chaque source.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->sources);
    }

    private function iterateOverSources(string $functionToCall): Collection
    {
        $books = new Collection();
        //dd(($this->sources));

        if (($this->sources)) {
            /* @var $source BookAbstractSource */
            /* @var $book Book */
            foreach ($this->sources as $source) {
                //dd($this->sources);
                foreach ($source->$functionToCall() as $book) {
                    $books[] = $book;
                }
            }
        }

        return $books;
    }

    /**
     * Récupère des statistiques
     * sur les différentes sources.
     */
    public function getStats()
    {
        $stats = [];

        // Nombre de source du catalogue
        $stats[get_class($this)] = $this->count();

        // Nombre d'books pour chaque source
        /* @var $source BookAbstractSource */
        foreach ($this->sources as $source) {
            $stats[get_class($source)] = $source->count();
        }

        return $stats;
    }
}
