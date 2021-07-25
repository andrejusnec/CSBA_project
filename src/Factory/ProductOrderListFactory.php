<?php

namespace App\Factory;

use App\Entity\ProductOrderList;
use App\Repository\ProductOrderListRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static ProductOrderList|Proxy createOne(array $attributes = [])
 * @method static ProductOrderList[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static ProductOrderList|Proxy find($criteria)
 * @method static ProductOrderList|Proxy findOrCreate(array $attributes)
 * @method static ProductOrderList|Proxy first(string $sortedField = 'id')
 * @method static ProductOrderList|Proxy last(string $sortedField = 'id')
 * @method static ProductOrderList|Proxy random(array $attributes = [])
 * @method static ProductOrderList|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductOrderList[]|Proxy[] all()
 * @method static ProductOrderList[]|Proxy[] findBy(array $attributes)
 * @method static ProductOrderList[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ProductOrderList[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductOrderListRepository|RepositoryProxy repository()
 * @method ProductOrderList|Proxy create($attributes = [])
 */
final class ProductOrderListFactory extends ModelFactory
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
            'quantity' => self::faker()->randomFloat(3),
            'price' => self::faker()->randomFloat(2, 1, 10),
            'total' => self::faker()->randomFloat(2, 1, 10),
            'product' => ProductsAndServicesFactory::randomOrCreate(),
            'color' => ColorFactory::randomOrCreate(),
            'size' => SizeFactory::randomOrCreate(),
            'order_id' => OrderFactory::randomOrCreate()
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(ProductOrderList $productOrderList) {})
        ;
    }

    protected static function getClass(): string
    {
        return ProductOrderList::class;
    }
}
