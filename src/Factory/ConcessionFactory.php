<?php

namespace App\Factory;

use App\Entity\Concession;
use App\Repository\ConcessionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Concession>
 *
 * @method        Concession|Proxy                     create(array|callable $attributes = [])
 * @method static Concession|Proxy                     createOne(array $attributes = [])
 * @method static Concession|Proxy                     find(object|array|mixed $criteria)
 * @method static Concession|Proxy                     findOrCreate(array $attributes)
 * @method static Concession|Proxy                     first(string $sortedField = 'id')
 * @method static Concession|Proxy                     last(string $sortedField = 'id')
 * @method static Concession|Proxy                     random(array $attributes = [])
 * @method static Concession|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ConcessionRepository|RepositoryProxy repository()
 * @method static Concession[]|Proxy[]                 all()
 * @method static Concession[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Concession[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Concession[]|Proxy[]                 findBy(array $attributes)
 * @method static Concession[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Concession[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ConcessionFactory extends ModelFactory
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
            'adresse' => self::faker()->streetAddress(),
            'codeInterne' => self::faker()->text(20),
            'codePostal' => self::faker()->postcode(),
            'libelleAffichage' => self::faker()->company(),
            'ville' => self::faker()->city(),
            'marques' => MarqueFactory::randomSet(rand(1,5)),
            'region' => RegionFactory::random()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
           // ->afterInstantiate(function(Concession $concession): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Concession::class;
    }
}
