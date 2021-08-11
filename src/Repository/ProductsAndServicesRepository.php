<?php

namespace App\Repository;

use App\Entity\ProductsAndServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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

    /**
     * @return QueryBuilder
     */
    public function findOnlyActiveProductsPagination(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('prod')
            ->andWhere('prod.isProduct = :val')
            ->andWhere('prod.isActive = :val')
            ->setParameter('val', true);
        return $qb;
    }



    public function findTenProducts(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.isProduct = :val')
            ->andWhere('p.isActive = :val')
            ->setParameter('val', true)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function getTagProductsQuery($tag): QueryBuilder
    {
        $qb = $this->createQueryBuilder('prod')
            ->andWhere(':val MEMBER OF prod.tags')
            ->setParameter('val', $tag->getId());
        return $qb;
    }

    /**
     * @param $term
     * @return QueryBuilder
     */
    public function findAllProductsWithSearchQueryBuilder($term): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p')
        ->innerJoin('p.tags',  't')
        ->addSelect('t');

        if($term) {
            $qb->andWhere('p.title LIKE :term OR t.name LIKE :term')
                ->setParameter('term', '%'.$term.'%')
                ->andWhere('p.isActive = :val AND p.isProduct = :val')
                ->setParameter('val', true);
        }
        return $qb;
    }


}
