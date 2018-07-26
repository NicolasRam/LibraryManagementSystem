<?php

namespace App\Repository;

use App\Entity\MemberEbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberEbook|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberEbook|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberEbook[]    findAll()
 * @method MemberEbook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberEbookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberEbook::class);
    }

//    /**
//     * @return MemberEbook[] Returns an array of MemberEbook objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MemberEbook
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
