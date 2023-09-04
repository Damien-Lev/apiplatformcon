<?php

namespace App\Command;

use App\Entity\Equipe;
use App\Entity\Joueur;
use App\Entity\Lobby;
use App\Entity\Manche;
use App\Entity\Partie;
use App\Entity\ResultatPartie;
use App\Entity\Saison;
use App\Tech\Doctrine\Purger\DatabasePurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:fixtures',
    description: 'Add a short description for your command',
)]
class FixturesCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly DatabasePurger $purger)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->purger->purge();
        $io = new SymfonyStyle($input, $output);

        foreach (range(1, 128) as $index) {
            if (($index-1) % 8 === 0) {
                $equipe = new Equipe();
                $equipe->setNom('Equipe '.round($index / 8 +1));
                $this->entityManager->persist($equipe);
            }
            $joueur = new Joueur();
            $joueur->setPseudo('joueur '.$index)->setEquipe($equipe);
            $this->entityManager->persist($joueur);
        }
        $this->entityManager->flush();
        $this->entityManager->clear();

        $dateSaison = new \DateTime('2010-01-01');
        for ($a = 1; $a <17; ++$a ) {
            $saison1 = new Saison();
            $saison1
                ->setState('terminee')
                ->setLibelle('Saison '.$a)
                ->setDateDebut(clone $dateSaison);
            $this->entityManager->persist($saison1);
            $this->handleSaisonTerminee($saison1, 12, 8);
            $dateSaison->modify('+3 months');
        }
        $this->entityManager->flush();
        $this->entityManager->clear();

        return Command::SUCCESS;
    }

    private function handleSaisonTerminee(Saison $saison, int $nbManches, int $nbParties): void {

        $joueurs = $this->entityManager->getRepository(Joueur::class)->findBy([], ['id' => 'ASC']);
        $nbLobbys = count($joueurs) / 8;
        $pointsLobbys = range(8,1, -1);
        $placesAttribuees = [];
        for ($a = 1; $a <= $nbLobbys; ++$a) {
            for ($b = 1; $b < 9;++$b) {
                $placesAttribuees[] = 10*$a + $b;
            }
        }
        foreach ($joueurs as $joueur) {
            $joueur->addSaison($saison);
        }
        /** @var \DateTime $dateSaison */
        $dateSaison = clone $saison->getDateDebut();
        for($i = 1; $i <= $nbManches; ++$i) {
            $manche = new Manche();
            $manche
                ->setSaison($saison)
                ->setState('terminee')
                ->setDate(clone $dateSaison);
            $saison->addManch($manche);
            $dateSaison->modify('+1 week');
            $this->entityManager->persist($manche);
            for ($j = 1; $j <= $nbParties; ++$j) {
                $partie = new Partie();
                $partie
                    ->setOrdre($j)
                    ->setState('terminee')
                    ->setManche($manche);
                $manche->addParty($partie);
                $this->entityManager->persist($partie);
                for ($k = 1; $k <= $nbLobbys; ++$k) {
                    $lobby = new Lobby();
                    $lobby
                        ->setPartie($partie)
                        ->setNumero($k);
                    $partie->addLobby($lobby);
                    $this->entityManager->persist($lobby);
                }
                $copieJoueurs = $joueurs;
                $placesAAttribuer = $placesAttribuees;
                while (!empty($copieJoueurs)) {
                    $indexJoueur = array_rand($copieJoueurs);
                    $sortant = $copieJoueurs[$indexJoueur];
                    $randomIndexJoueur = array_rand($placesAAttribuer);
                    $indexLobbyJoueur = ((int)floor($placesAAttribuer[$randomIndexJoueur] / 10)) - 1;
                    $lobby = $partie->getLobbys()->toArray()[$indexLobbyJoueur];
                    $place = $placesAAttribuer[$randomIndexJoueur] % 10;
                    $points = $pointsLobbys[$place - 1];
                    $resultatPartie = new ResultatPartie();
                    $resultatPartie
                        ->setPlace($place)
                        ->setPoints($points)
                        ->setJoueur($sortant)
                        ->setLobby($lobby);
                    $sortant->addResultat($resultatPartie);
                    $lobby->addResultat($resultatPartie);
                    $this->entityManager->persist($resultatPartie);
                    array_splice($copieJoueurs, $indexJoueur, 1);
                    array_splice($placesAAttribuer, $randomIndexJoueur, 1);
                }
            }
        }
    }
}
