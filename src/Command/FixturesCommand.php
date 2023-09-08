<?php

namespace App\Command;

use App\Factory\CategorieFactory;
use App\Factory\ConcessionFactory;
use App\Factory\MarqueFactory;
use App\Factory\ModeleFactory;
use App\Factory\OptionFactory;
use App\Factory\RegionFactory;
use App\Factory\VehiculeFactory;
use App\Tech\Doctrine\Purger\DatabasePurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:fixtures',
    description: 'Add a short description for your command',
)]
class FixturesCommand extends Command
{
    public function __construct(private readonly DatabasePurger $purger)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->purger->purge();

        CategorieFactory::createOne(['code' => 'VN']);
        CategorieFactory::createOne(['code' => 'VO']);
        CategorieFactory::createOne(['code' => 'VE']);
        CategorieFactory::createOne(['code' => 'VD']);
        RegionFactory::createOne(['libelle' => 'Nord']);
        RegionFactory::createOne(['libelle' => 'Sud']);
        RegionFactory::createOne(['libelle' => 'Ouest']);
        RegionFactory::createOne(['libelle' => 'Est']);
        MarqueFactory::createOne(['code' => 'PEU','libelle' => 'Peugeot']);
        MarqueFactory::createOne(['code' => 'REN','libelle' => 'Renault']);
        MarqueFactory::createOne(['code' => 'DS','libelle' => 'DS']);
        MarqueFactory::createOne(['code' => 'CIT','libelle' => 'Citroën']);
        MarqueFactory::createOne(['code' => 'DAC','libelle' => 'Dacia']);
        $modelesParMarque = [
            'PEU' => [
                '208',
                '2008',
                '308',
                '408',
                '508',
                '5008',
                'Rifer',
                'Expert',
                'Traveller'
            ],
                    'REN' => [
                'Clio',
                'Twingo',
                'Zoe',
                'Captur',
                'Megane',
                'Arkana',
                'Kangoo',
                'Trafic',
                'Twizy'
            ],
                    'DS' => [
                'DS3',
                'DS4',
                'DS7',
                'DS9'
            ],
                    'CIT' => [
                'C3',
                'Oli',
                'Ami',
                'C4',
                'C5',
                'Berlingo',
                'SpaceTourer'
            ],
                    'DAC' => [
                'Sping',
                'Sandero',
                'Duster',
                'Jogger'
                    ]
        ];
        foreach ($modelesParMarque as $marque => $modeles) {
            $marque = MarqueFactory::repository()->createQueryBuilder('m')->where('m.code = :code')->setParameter('code',$marque)->getQuery()->getOneOrNullResult();
            foreach ($modeles as $modele) {
                ModeleFactory::createOne(['marque' => $marque, 'libelle' => $modele]);
            }
        }
        ConcessionFactory::createMany(200);
        OptionFactory::createMany(200, static function () {
            return ['marque' => MarqueFactory::random()];
        });

        return Command::SUCCESS;
    }
}
