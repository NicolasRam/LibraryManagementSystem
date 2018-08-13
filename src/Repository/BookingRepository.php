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

//            dump('Entering sql task');
//            $conn = $this->getEntityManager()->getConnection();
//            dump('Contact has been made with database');

//             $sql = 'SELECT COUNT(pbook.book_id) as c, book.title
//              FROM booking
//              JOIN pbook ON pbook.id = booking.p_book_id
//              JOIN book ON book.id = pbook.book_id
//              GROUP BY pbook.book_id
//              ORDER BY c DESC
//             ';
//
//            $stmt = $conn->prepare($sql);
//
////            dump('Executing');
//            $stmt->execute();
////            dd($stmt);
//            dump('Everything goes well');
//            return $stmt->fetchAll();


//        dump('Just before myquery');
        $myQuery = $this
            ->createQueryBuilder('booking')
            ->join('booking.pBook', 'pbook')
//            ->addSelect('pbook')
            ->join('pbook.book', 'book')
//            ->addSelect('book')
            ->groupBy('book.id')
            ->orderBy('book.id')
            ->setMaxResults($topNumber)
        ;

//        dump($myQuery->getQuery()->getSQL());
//        dump($myQuery->getQuery()->getResult());

//        dump('---> After query Result');

        return $myQuery
            ->getQuery()
            ->getResult();

        } catch (NonUniqueResultException $e) {
            echo "erreur Repo";
            return [0];
        }


    }
}
