<?php

namespace App\Repository;

use App\Entity\ProductsAndServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductsAndServices|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductsAndServices|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductsAndServices[]    findAll()
 * @method ProductsAndServices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsAndServicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductsAndServices::class);
    }

    /**
     * @return ProductsAndServices[] Returns an array of ProductsAndServices objects
     */
    public function getParents(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.parent is null')
            ->andWhere('p.isActive = :val')
            ->setParameter('val', true)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return ProductsAndServices[] Returns an array of ProductsAndServices objects
    //  */

    /**
     * @return int|mixed|string
     */
    public function findOnlyActiveProducts()
    {
        return $this->createQueryBuilder('prod')
            ->andWhere('prod.isProduct = :val')
            ->andWhere('prod.isActive = :val')
            ->setParameter('val', true)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?ProductsAndServices
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
