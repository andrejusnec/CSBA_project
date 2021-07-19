<?php

namespace App\Factory;

use App\Entity\ProductBalance;
use App\Repository\ProductBalanceRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static ProductBalance|Proxy createOne(array $attributes = [])
 * @method static ProductBalance[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static ProductBalance|Proxy find($criteria)
 * @method static ProductBalance|Proxy findOrCreate(array $attributes)
 * @method static ProductBalance|Proxy first(string $sortedField = 'id')
 * @method static ProductBalance|Proxy last(string $sortedField = 'id')
 * @method static ProductBalance|Proxy random(array $attributes = [])
 * @method static ProductBalance|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductBalance[]|Proxy[] all()
 * @method static ProductBalance[]|Proxy[] findBy(array $attributes)
 * @method static ProductBalance[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ProductBalance[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductBalanceRepository|RepositoryProxy repository()
 * @method ProductBalance|Proxy create($attributes = [])
 */
final class ProductBalanceFactory extends ModelFactory
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
            'reserved' => self::faker()->randomFloat(3, 1, 10),
            'product_supply' => $this->productSupplyChance(70),
            'product' => ProductsAndServicesFactory::randomOrCreate(),
            'color' => ColorFactory::randomOrCreate(),
            'size' => SizeFactory::randomOrCreate(),
            'order_id' => OrderFactory::randomOrCreate()
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this// ->afterInstantiate(function(ProductBalance $productBalance) {})
            ;
    }

    protected static function getClass(): string
    {
        return ProductBalance::class;
    }
}
