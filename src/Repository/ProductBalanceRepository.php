<?php

namespace App\Repository;

use App\Entity\ProductBalance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductBalance|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductBalance|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductBalance[]    findAll()
 * @method ProductBalance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductBalanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductBalance::class);
    }

    // /**
    //  * @return ProductBalance[] Returns an array of ProductBalance objects
    //  */

    /**
     * @throws NoResultException|NonUniqueResultException
     */
    public function countProductBalance($product)
    {
        return $this->createQueryBuilder('pb')
            ->andWhere('pb.product = :val')
            ->setParameter('val', $product)
            ->select('SUM(pb.quantity) as productsInStock')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?ProductBalance
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
