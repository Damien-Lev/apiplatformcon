<?php

namespace App\Factory;

use App\Entity\Marque;
use App\Repository\MarqueRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Marque>
 *
 * @method        Marque|Proxy                     create(array|callable $attributes = [])
 * @method static Marque|Proxy                     createOne(array $attributes = [])
 * @method static Marque|Proxy                     find(object|array|mixed $criteria)
 * @method static Marque|Proxy                     findOrCreate(array $attributes)
 * @method static Marque|Proxy                     first(string $sortedField = 'id')
 * @method static Marque|Proxy                     last(string $sortedField = 'id')
 * @method static Marque|Proxy                     random(array $attributes = [])
 * @method static Marque|Proxy                     randomOrCreate(array $attributes = [])
 * @method static MarqueRepository|RepositoryProxy repository()
 * @method static Marque[]|Proxy[]                 all()
 * @method static Marque[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Marque[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Marque[]|Proxy[]                 findBy(array $attributes)
 * @method static Marque[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Marque[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class MarqueFactory extends ModelFactory
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
            'code' => self::faker()->text(30),
            'libelle' => self::faker()->text(50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Marque $marque): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Marque::class;
    }
}
