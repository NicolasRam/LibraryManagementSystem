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
}
