<?php

namespace App\Factory;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Order|Proxy createOne(array $attributes = [])
 * @method static Order[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Order|Proxy find($criteria)
 * @method static Order|Proxy findOrCreate(array $attributes)
 * @method static Order|Proxy first(string $sortedField = 'id')
 * @method static Order|Proxy last(string $sortedField = 'id')
 * @method static Order|Proxy random(array $attributes = [])
 * @method static Order|Proxy randomOrCreate(array $attributes = [])
 * @method static Order[]|Proxy[] all()
 * @method static Order[]|Proxy[] findBy(array $attributes)
 * @method static Order[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Order[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static OrderRepository|RepositoryProxy repository()
 * @method Order|Proxy create($attributes = [])
 */
final class OrderFactory extends ModelFactory
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
            'address' => self::faker()->address,
            'city' => self::faker()->city,
            'post_code' => self::faker()->postcode,
            'order_number' => self::faker()->text(),
            'date' => self::faker()->dateTimeBetween('-20 days', 'now', 'Europe/Vilnius'),
            'isActive' => self::faker()->boolean(95),
            'status' => true,
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Order $order) {})
        ;
    }

    protected static function getClass(): string
    {
        return Order::class;
    }
}
