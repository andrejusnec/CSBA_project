<?php

namespace App\Factory;

use App\Entity\Size;
use App\Repository\SizeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Size|Proxy createOne(array $attributes = [])
 * @method static Size[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Size|Proxy find($criteria)
 * @method static Size|Proxy findOrCreate(array $attributes)
 * @method static Size|Proxy first(string $sortedField = 'id')
 * @method static Size|Proxy last(string $sortedField = 'id')
 * @method static Size|Proxy random(array $attributes = [])
 * @method static Size|Proxy randomOrCreate(array $attributes = [])
 * @method static Size[]|Proxy[] all()
 * @method static Size[]|Proxy[] findBy(array $attributes)
 * @method static Size[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Size[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static SizeRepository|RepositoryProxy repository()
 * @method Size|Proxy create($attributes = [])
 */
final class SizeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'isActive' => self::faker()->boolean(99),
            'title' => self::faker()->unique()->randomElement($sizes)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Size $size) {})
        ;
    }

    protected static function getClass(): string
    {
        return Size::class;
    }
}
