<?php

namespace App\Factory;

use App\Entity\Compteur;
use App\Repository\CompteurRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Compteur>
 *
 * @method        Compteur|Proxy                     create(array|callable $attributes = [])
 * @method static Compteur|Proxy                     createOne(array $attributes = [])
 * @method static Compteur|Proxy                     find(object|array|mixed $criteria)
 * @method static Compteur|Proxy                     findOrCreate(array $attributes)
 * @method static Compteur|Proxy                     first(string $sortedField = 'id')
 * @method static Compteur|Proxy                     last(string $sortedField = 'id')
 * @method static Compteur|Proxy                     random(array $attributes = [])
 * @method static Compteur|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CompteurRepository|RepositoryProxy repository()
 * @method static Compteur[]|Proxy[]                 all()
 * @method static Compteur[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Compteur[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Compteur[]|Proxy[]                 findBy(array $attributes)
 * @method static Compteur[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Compteur[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CompteurFactory extends ModelFactory
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
            'name' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Compteur $compteur): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Compteur::class;
    }
}
