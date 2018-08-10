<?php

namespace App\Repository;

use App\Entity\Booking;
use App\Entity\Library;
use App\Entity\PBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    /**
     * Récupère les suggestions d'articles
     *
     * @param $libraryId
     *
     * @return mixed
     */
    public function findLibraryLateBooking($libraryId)
    {
        return $this->createQueryBuilder('booking')
            ->join( PBook::class, 'pbook' )
            ->join( Library::class, 'library' )

            ->where('booking.endDate < CURRENT_DATE()')
            ->andWhere('booking.returnDate IS NULL')
            ->andWhere('library.id != :library_id')
            ->setParameter('library_id', $libraryId)

            ->getQuery()
            ->getResult();
    }
}
