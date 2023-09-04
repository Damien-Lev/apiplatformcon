<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use App\Processor\ResultatRaison\SaisirResultatProcessor;
use App\Repository\ResultatPartieRepository;
use App\Tech\Api\Listener\KernelResponseListener;
use Doctrine\ORM\Mapping as ORM;
use PgSql\Lob;

#[ORM\Entity(repositoryClass: ResultatPartieRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Patch(
            uriTemplate: '/resultat_parties/{id}/saisir_resultat',
            processor: SaisirResultatProcessor::class,
            extraProperties: [KernelResponseListener::VIEW_UPDATE_LIST => ['v_classement_saison']]
        )
    ]
)]
class ResultatPartie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'resultats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lobby $lobby = null;

    #[ORM\ManyToOne(inversedBy: 'resultats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Joueur $joueur = null;

    #[ORM\Column(nullable: true)]
    private ?int $place = null;

    #[ORM\Column(nullable: false)]
    private int $points = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLobby(): ?Lobby
    {
        return $this->lobby;
    }

    public function setLobby(?Lobby $lobby): static
    {
        $this->lobby = $lobby;

        return $this;
    }

    public function getJoueur(): ?Joueur
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueur $joueur): static
    {
        $this->joueur = $joueur;

        return $this;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(?int $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }
}
