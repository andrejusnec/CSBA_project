<?php

namespace App\Repository;

use App\Entity\Price;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @method Price|null find($id, $lockMode = null, $lockVersion = null)
 * @method Price|null findOneBy(array $criteria, array $orderBy = null)
 * @method Price[]    findAll()
 * @method Price[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Price::class);
    }

    // /**
    //  * @return Price[] Returns an array of Price objects
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


    public function findAllByProductAndDate($product_id): ?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.product = :val')
            ->andWhere('p.period <= :val2')
            ->setParameter('val', $product_id)
            ->setParameter('val2',  \date('Y-m-d'))
            ->orderBy('p.period','DESC')
            ->getQuery()
            ->getResult();
    }

}
