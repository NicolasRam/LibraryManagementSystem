<?php

namespace App\Repository;

use App\Entity\PBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**

 * @method PBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method PBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method PBook[]    findAll()
 * @method PBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)

 */
class PBookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PBook::class);
    }

//    /**
//     * @return PBook[] Returns an array of PBook objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PBook
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
