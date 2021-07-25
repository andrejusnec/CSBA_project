<?php

namespace App\Factory;

use App\Entity\Color;
use App\Repository\ColorRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Color|Proxy createOne(array $attributes = [])
 * @method static Color[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Color|Proxy find($criteria)
 * @method static Color|Proxy findOrCreate(array $attributes)
 * @method static Color|Proxy first(string $sortedField = 'id')
 * @method static Color|Proxy last(string $sortedField = 'id')
 * @method static Color|Proxy random(array $attributes = [])
 * @method static Color|Proxy randomOrCreate(array $attributes = [])
 * @method static Color[]|Proxy[] all()
 * @method static Color[]|Proxy[] findBy(array $attributes)
 * @method static Color[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Color[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ColorRepository|RepositoryProxy repository()
 * @method Color|Proxy create($attributes = [])
 */
final class ColorFactory extends ModelFactory
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
            'isActive' => self::faker()->boolean(70),
            'title' => self::faker()->colorName(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Color $color) {})
        ;
    }

    protected static function getClass(): string
    {
        return Color::class;
    }
}
