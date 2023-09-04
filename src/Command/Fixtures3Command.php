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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:fixtures3',
    description: 'Add a short description for your command',
)]
class Fixtures3Command extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly DatabasePurger $purger)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $dateSaison = new \DateTime('2018-01-01');
        for ($a = 34; $a <55; ++$a ) {
            $saison1 = new Saison();
            $saison1
                ->setState('terminee')
                ->setLibelle('Saison '.$a)
                ->setDateDebut(clone $dateSaison);
            $this->entityManager->persist($saison1);
            $this->handleSaisonTerminee($saison1, 12, 8);
            $dateSaison->modify('+3 months');
            $this->entityManager->flush();
            $this->entityManager->clear();
        }

        $saisonEnCours = new Saison();
        $saisonEnCours
            ->setState('en_cours')
            ->setLibelle('Saison 56')
            ->setDateDebut(clone $dateSaison);
        $this->entityManager->persist($saisonEnCours);
        $this->handleSaisonEncours($saisonEnCours, 12, 8, 10);
        $this->entityManager->flush();
        $this->entityManager->clear();
        $io->success('Fixtures created.');

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

    private function handleSaisonEncours(Saison $saison, int $nbManches, int $nbParties, int $indexProchaineManche) {
        $this->handleSaisonTerminee($saison, $indexProchaineManche - 1, $nbParties);
        $dateSaison = (clone $saison->getManches()->last()->getDate())->modify('+1 week');
        $joueurs = $this->entityManager->getRepository(Joueur::class)->findBy([], ['id' => 'ASC']);
        $nbLobbys = count($joueurs) / 8;
        $placesAttribuees = [];
        for ($a = 1; $a <= $nbLobbys; ++$a) {
            for ($b = 1; $b < 9;++$b) {
                $placesAttribuees[] = 10*$a + $b;
            }
        }
        foreach ($joueurs as $joueur) {
            $joueur->addSaison($saison);
        }
        for($i = 1; $i <= $nbManches; ++$i) {
            $manche = new Manche();
            $manche
                ->setSaison($saison)
                ->setState('prevue')
                ->setDate(clone $dateSaison);
            $dateSaison->modify('+1 week');
            $this->entityManager->persist($manche);
            for ($j = 1; $j <= $nbParties; ++$j) {
                $partie = new Partie();
                $partie
                    ->setOrdre($j)
                    ->setState('prevue')
                    ->setManche($manche);
                $this->entityManager->persist($partie);
                for ($k = 1; $k <= $nbLobbys; ++$k) {
                    $lobby = new Lobby();
                    $lobby
                        ->setPartie($partie)
                        ->setNumero($k);
                    $this->entityManager->persist($lobby);
                    $partie->addLobby($lobby);
                }
                $copieJoueurs = $joueurs;
                $placesAAttribuer = $placesAttribuees;
                while (!empty($copieJoueurs)) {
                    $indexJoueur = array_rand($copieJoueurs);
                    $sortant = $copieJoueurs[$indexJoueur];
                    $randomIndexJoueur = array_rand($placesAAttribuer);
                    $indexLobbyJoueur = ((int)floor($placesAAttribuer[$randomIndexJoueur] / 10)) - 1;
                    $lobby = $partie->getLobbys()->toArray()[$indexLobbyJoueur];
                    $resultatPartie = new ResultatPartie();
                    $resultatPartie
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
