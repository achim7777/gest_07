<?php

namespace App\Factory;

use App\Entity\Etudiants;
use App\Repository\EtudiantsRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Etudiants>
 *
 * @method        Etudiants|Proxy create(array|callable $attributes = [])
 * @method static Etudiants|Proxy createOne(array $attributes = [])
 * @method static Etudiants|Proxy find(object|array|mixed $criteria)
 * @method static Etudiants|Proxy findOrCreate(array $attributes)
 * @method static Etudiants|Proxy first(string $sortedField = 'id')
 * @method static Etudiants|Proxy last(string $sortedField = 'id')
 * @method static Etudiants|Proxy random(array $attributes = [])
 * @method static Etudiants|Proxy randomOrCreate(array $attributes = [])
 * @method static EtudiantsRepository|RepositoryProxy repository()
 * @method static Etudiants[]|Proxy[] all()
 * @method static Etudiants[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Etudiants[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Etudiants[]|Proxy[] findBy(array $attributes)
 * @method static Etudiants[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Etudiants[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class EtudiantsFactory extends ModelFactory
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
            'adress' => self::faker()->address(),
            'cne' => self::faker()->realText(10),
            'email' => self::faker()->email(),
            'nom' => self::faker()->lastName(),
            'prenom' => self::faker()->firstName(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Etudiants $etudiants): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Etudiants::class;
    }
}
