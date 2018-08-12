<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use PHPUnit\Framework\Constraint\CountTest;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;

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
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findPbooktop($topNumber): array
    {

        try {

            dump('Entering sql task');

            $conn = $this->getEntityManager()->getConnection();

            dump('Contact has been made with database');

            $sql = 'select book.title as Titre, book.isbn as ISBN, COUNT(pbook.status=\'not_available\'),
 COUNT(pbook.id) as Nombre
 from booking, pbook JOIN book ON book.id = pbook.book_id WHERE booking.p_book_id = pbook.id
 GROUP BY pbook.id
 ORDER BY COUNT(pbook.id) DESC
 LIMIT 10';

            $stmt = $conn->prepare($sql);

//            dump('Executing');
            $stmt->execute();
//            dd($stmt);
            // returns an array of arrays (i.e. a raw data set)
            dump('Everything goes well');
            return $stmt->fetchAll();
//dump('just before myquery');
//        $myQuery = $this
//            ->createQueryBuilder('a')
////            ->select('a')
////            ->from('Booking', 'a')
//            ->leftjoin('a.pBook', 'p')
//
////            ->addSelect('a AS Booking')
//            ->addSelect('p')
//            ->leftjoin('p.book', 'b')
////            ->orderBy('COUNT(b.id)', 'DESC')
////            ->where('')
//            ->addSelect('b', 'book')
////            ->groupBy(Book::class)
////                ->addGroupBy('b.id')
////            ->orderBy('book', 'DESC')
////                ->addOrderBy('b.id', 'DESC')
//            ->setMaxResults($topNumber)
//        ;


//                return $myQuery
//            ->getQuery()
//            ->getResult();

        } catch (NonUniqueResultException $e) {
            echo "erreur Repo";
            return [0];
        }


    }
}
