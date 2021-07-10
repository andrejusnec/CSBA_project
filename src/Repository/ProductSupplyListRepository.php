<?php

namespace App\Repository;

use App\Entity\ProductSupplyList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductSupplyList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductSupplyList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductSupplyList[]    findAll()
 * @method ProductSupplyList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductSupplyListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductSupplyList::class);
    }

    // /**
    //  * @return ProductSupplyList[] Returns an array of ProductSupplyList objects
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
    public function findOneBySomeField($value): ?ProductSupplyList
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
