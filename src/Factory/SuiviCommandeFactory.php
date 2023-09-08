<?php

namespace App\Factory;

use App\Entity\SuiviCommande;
use App\Repository\SuiviCommandeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<SuiviCommande>
 *
 * @method        SuiviCommande|Proxy                     create(array|callable $attributes = [])
 * @method static SuiviCommande|Proxy                     createOne(array $attributes = [])
 * @method static SuiviCommande|Proxy                     find(object|array|mixed $criteria)
 * @method static SuiviCommande|Proxy                     findOrCreate(array $attributes)
 * @method static SuiviCommande|Proxy                     first(string $sortedField = 'id')
 * @method static SuiviCommande|Proxy                     last(string $sortedField = 'id')
 * @method static SuiviCommande|Proxy                     random(array $attributes = [])
 * @method static SuiviCommande|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SuiviCommandeRepository|RepositoryProxy repository()
 * @method static SuiviCommande[]|Proxy[]                 all()
 * @method static SuiviCommande[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static SuiviCommande[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static SuiviCommande[]|Proxy[]                 findBy(array $attributes)
 * @method static SuiviCommande[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static SuiviCommande[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SuiviCommandeFactory extends ModelFactory
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
            'dateCommande' => self::faker()->dateTimeBetween('-60 days','-45 days'),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(SuiviCommande $suiviCommande): void {})
        ;
    }

    protected static function getClass(): string
    {
        return SuiviCommande::class;
    }
}
