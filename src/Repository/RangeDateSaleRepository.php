<?php

namespace App\Repository;

use App\Entity\RangeDateSale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RangeDateSale|null find($id, $lockMode = null, $lockVersion = null)
 * @method RangeDateSale|null findOneBy(array $criteria, array $orderBy = null)
 * @method RangeDateSale[]    findAll()
 * @method RangeDateSale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RangeDateSaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RangeDateSale::class);
    }

    // /**
    //  * @return RangeDateSale[] Returns an array of RangeDateSale objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RangeDateSale
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
