<?php

namespace App\Factory;

use App\Entity\ProductSupplyList;
use App\Repository\ProductSupplyListRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static ProductSupplyList|Proxy createOne(array $attributes = [])
 * @method static ProductSupplyList[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static ProductSupplyList|Proxy find($criteria)
 * @method static ProductSupplyList|Proxy findOrCreate(array $attributes)
 * @method static ProductSupplyList|Proxy first(string $sortedField = 'id')
 * @method static ProductSupplyList|Proxy last(string $sortedField = 'id')
 * @method static ProductSupplyList|Proxy random(array $attributes = [])
 * @method static ProductSupplyList|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductSupplyList[]|Proxy[] all()
 * @method static ProductSupplyList[]|Proxy[] findBy(array $attributes)
 * @method static ProductSupplyList[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ProductSupplyList[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductSupplyListRepository|RepositoryProxy repository()
 * @method ProductSupplyList|Proxy create($attributes = [])
 */
final class ProductSupplyListFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }


    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'quantity' => self::faker()->randomFloat(3, 1, 10),
            'color' => ColorFactory::random(),
            'size' => SizeFactory::random(),
            'product' => ProductsAndServicesFactory::random(),
            'product_supply' => $this->productSupplyChance(70)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(ProductSupplyList $productSupplyList) {})
        ;
    }

    protected static function getClass(): string
    {
        return ProductSupplyList::class;
    }
}
