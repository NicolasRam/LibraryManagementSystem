<?php

namespace App\Repository;

use App\Entity\Liberian;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Liberian|null find($id, $lockMode = null, $lockVersion = null)
 * @method Liberian|null findOneBy(array $criteria, array $orderBy = null)
 * @method Liberian[]    findAll()
 * @method Liberian[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiberianRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Liberian::class);
    }

//    /**
//     * @return Liberian[] Returns an array of Liberian objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Liberian
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
