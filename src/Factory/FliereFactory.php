<?php

namespace App\Factory;

use App\Entity\Fliere;
use App\Repository\FliereRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Fliere>
 *
 * @method        Fliere|Proxy create(array|callable $attributes = [])
 * @method static Fliere|Proxy createOne(array $attributes = [])
 * @method static Fliere|Proxy find(object|array|mixed $criteria)
 * @method static Fliere|Proxy findOrCreate(array $attributes)
 * @method static Fliere|Proxy first(string $sortedField = 'id')
 * @method static Fliere|Proxy last(string $sortedField = 'id')
 * @method static Fliere|Proxy random(array $attributes = [])
 * @method static Fliere|Proxy randomOrCreate(array $attributes = [])
 * @method static FliereRepository|RepositoryProxy repository()
 * @method static Fliere[]|Proxy[] all()
 * @method static Fliere[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Fliere[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Fliere[]|Proxy[] findBy(array $attributes)
 * @method static Fliere[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Fliere[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FliereFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'nom' => self::faker()->realText(10),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Fliere $fliere): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Fliere::class;
    }
}
