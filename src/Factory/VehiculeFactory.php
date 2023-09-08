<?php

namespace App\Factory;

use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Vehicule>
 *
 * @method        Vehicule|Proxy                     create(array|callable $attributes = [])
 * @method static Vehicule|Proxy                     createOne(array $attributes = [])
 * @method static Vehicule|Proxy                     find(object|array|mixed $criteria)
 * @method static Vehicule|Proxy                     findOrCreate(array $attributes)
 * @method static Vehicule|Proxy                     first(string $sortedField = 'id')
 * @method static Vehicule|Proxy                     last(string $sortedField = 'id')
 * @method static Vehicule|Proxy                     random(array $attributes = [])
 * @method static Vehicule|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VehiculeRepository|RepositoryProxy repository()
 * @method static Vehicule[]|Proxy[]                 all()
 * @method static Vehicule[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Vehicule[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Vehicule[]|Proxy[]                 findBy(array $attributes)
 * @method static Vehicule[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Vehicule[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VehiculeFactory extends ModelFactory
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
            'car' => self::faker()->unique()->regexify('[A-Z]{2}\d{4}'),
            'categorie' => CategorieFactory::random(),
            'marque' => MarqueFactory::random(),
            'vin' => self::faker()->unique()->regexify('V[FR]3[A-Z]{8}\d{6}'),
            'options' => OptionFactory::randomSet(4, ['marque' => MarqueFactory::random()]),
            'suiviCommande' => SuiviCommandeFactory::new()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
          //  ->afterInstantiate(function(Vehicule $vehicule): void {
          //  })
        ;
    }

    protected static function getClass(): string
    {
        return Vehicule::class;
    }
}
