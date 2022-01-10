<?php

namespace App\Repository;

use App\Entity\Cepage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cepage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cepage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cepage[]    findAll()
 * @method Cepage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CepageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cepage::class);
    }

    // /**
    //  * @return Cepage[] Returns an array of Cepage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cepage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
