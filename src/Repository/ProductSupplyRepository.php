<?php

namespace App\Repository;

use App\Entity\ProductSupply;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductSupply|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductSupply|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductSupply[]    findAll()
 * @method ProductSupply[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductSupplyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductSupply::class);
    }

    // /**
    //  * @return ProductSupply[] Returns an array of ProductSupply objects
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
    public function findOneBySomeField($value): ?ProductSupply
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
