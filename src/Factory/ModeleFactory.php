<?php

namespace App\Factory;

use App\Entity\Modele;
use App\Repository\ModeleRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Modele>
 *
 * @method        Modele|Proxy                     create(array|callable $attributes = [])
 * @method static Modele|Proxy                     createOne(array $attributes = [])
 * @method static Modele|Proxy                     find(object|array|mixed $criteria)
 * @method static Modele|Proxy                     findOrCreate(array $attributes)
 * @method static Modele|Proxy                     first(string $sortedField = 'id')
 * @method static Modele|Proxy                     last(string $sortedField = 'id')
 * @method static Modele|Proxy                     random(array $attributes = [])
 * @method static Modele|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ModeleRepository|RepositoryProxy repository()
 * @method static Modele[]|Proxy[]                 all()
 * @method static Modele[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Modele[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Modele[]|Proxy[]                 findBy(array $attributes)
 * @method static Modele[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Modele[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ModeleFactory extends ModelFactory
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
            'libelle' => self::faker()->text(255),
            'marque' => MarqueFactory::new()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
       //     ->afterInstantiate(function(Modele $modele): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Modele::class;
    }

}
