<?php

namespace App\Command;

use App\Factory\CategorieFactory;
use App\Factory\ConcessionFactory;
use App\Factory\MarqueFactory;
use App\Factory\ModeleFactory;
use App\Factory\OptionFactory;
use App\Factory\VehiculeFactory;
use App\Tech\Doctrine\Purger\DatabasePurger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:add-vehicules',
)]
class AddVehiculesCommand extends Command
{
    public function __construct(private readonly DatabasePurger $purger)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        VehiculeFactory::createMany(10000,
            static function () {
                $marque = MarqueFactory::random();
                $concessionRepository = ConcessionFactory::repository();
                $concessionsPossibles = $concessionRepository->createQueryBuilder('concession')
                    ->join('concession.marques','marque')
                    ->where('marque = :marque')
                    ->setParameter('marque',$marque->getId())
                    ->getQuery()
                    ->getResult();
                $concession = $concessionsPossibles[array_rand($concessionsPossibles)];
                return [
                    'marque' => $marque,
                    'concession' => $concession,
                    'modele' => ModeleFactory::random(['marque' => $marque->getId()])
                ];
            }


        );
        return Command::SUCCESS;
    }
}
