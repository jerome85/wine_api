<?php

namespace App\Repository;

use App\Entity\Millesime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Millesime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Millesime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Millesime[]    findAll()
 * @method Millesime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MillesimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Millesime::class);
    }

    // /**
    //  * @return Millesime[] Returns an array of Millesime objects
    //  */
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
    public function findOneBySomeField($value): ?Millesime
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
