<?php


namespace App\Manager;


use App\Repository\PriceRepository;
use Doctrine\DBAL\Exception;

class PriceManager
{
    private PriceRepository $repository;

    /**
     * PriceManager constructor.
     * @param PriceRepository $repository
     */
    public function __construct(PriceRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getAllByProductAndDate($product_id): ?array
    {
        return $this->repository->findAllByProductAndDate($product_id);
    }

    public function getPriceByPeriod($product_id): int
    {
        $priceList = $this->getAllByProductAndDate($product_id);
        if($priceList !== null && $priceList !== []) {
            return $priceList[0]->getPrice();
        } else {
            return 0;
        }
    }

    public function getOldAndHigherPrice($product_id) :int
    {
        $priceList = $this->getAllByProductAndDate($product_id);
        if($priceList !== null && $priceList !== []) {
            return $priceList[0]->getPrice();
        } else {
            return 0;
        }
    }
}