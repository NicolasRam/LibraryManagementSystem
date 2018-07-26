<?php

namespace App\Repository;

use App\Entity\Pbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pbook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pbook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pbook[]    findAll()
 * @method Pbook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PbookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pbook::class);
    }

//    /**
//     * @return Pbook[] Returns an array of Pbook objects
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
    public function findOneBySomeField($value): ?Pbook
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
