<?php

namespace App\Repository;

use App\Entity\ProgramPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProgramPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramPrice[]    findAll()
 * @method ProgramPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramPrice::class);
    }

    // /**
    //  * @return ProgramPrice[] Returns an array of ProgramPrice objects
    //  */
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
    public function findOneBySomeField($value): ?ProgramPrice
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
