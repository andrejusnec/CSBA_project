<?php

namespace App\Factory;

use App\Entity\ProductSupply;
use App\Repository\ProductSupplyRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static ProductSupply|Proxy createOne(array $attributes = [])
 * @method static ProductSupply[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static ProductSupply|Proxy find($criteria)
 * @method static ProductSupply|Proxy findOrCreate(array $attributes)
 * @method static ProductSupply|Proxy first(string $sortedField = 'id')
 * @method static ProductSupply|Proxy last(string $sortedField = 'id')
 * @method static ProductSupply|Proxy random(array $attributes = [])
 * @method static ProductSupply|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductSupply[]|Proxy[] all()
 * @method static ProductSupply[]|Proxy[] findBy(array $attributes)
 * @method static ProductSupply[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ProductSupply[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductSupplyRepository|RepositoryProxy repository()
 * @method ProductSupply|Proxy create($attributes = [])
 */
final class ProductSupplyFactory extends ModelFactory
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
            'order_number' => self::faker()->unique->word(),
            'date' => self::faker()->dateTimeBetween('-10 days', 'now', 'Europe/Vilnius'),
            'isActive' => self::faker()->boolean(75),
            'status' => true
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(ProductSupply $productSupply) {})
        ;
    }

    protected static function getClass(): string
    {
        return ProductSupply::class;
    }
}
