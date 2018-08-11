<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use PHPUnit\Framework\Constraint\CountTest;
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
     * @param $value
     * @return mixed
     */
    public function findValueOfBookingForOneMember($value)
    {

        try {
            $count = $this->createQueryBuilder('a')
                ->select('COUNT(a)')
                ->where('a.member = :member_id')
                ->setParameter('member_id', $value)
                ->andWhere('a.endDate > CURRENT_DATE()')
                ->getQuery()
                ->getSingleScalarResult();

        } catch (NonUniqueResultException $e) {
            return 0;
        }

        return $count;
    }


    /**
     * @param $topNumber
     * @return mixed
     */
    public function findPbooktop($topNumber)
    {

//        try {
        $myQuery = $this->createQueryBuilder('a')
            ->select('a')
            ->leftjoin('pbook', 'pbook', 'WITH', 'pbook.id = a.p_book_id')
            ->leftjoin('book', 'book', 'WITH', 'book.id = pbook.id')
            ->groupBy('pbook.id')
//            ->orderBy(Count('pbook.id'), 'DESC')
            ->setMaxResults($topNumber)
            ->getQuery();

//        dd($myQuery);

        return $myQuery;
//        } catch (NonUniqueResultException $e) {
//            return 0;
//        }
// select book.title as Titre, book.isbn as ISBN, COUNT(pbook.status=not_available),
// COUNT(pbook.id) as Nombre
// from booking, pbook JOIN book ON book.id = pbook.book_id WHERE booking.p_book_id = pbook.id
// GROUP BY pbook.id
// ORDER BY COUNT(pbook.id) DESC
// LIMIT 10

    }
}
