<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LobbyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LobbyRepository::class)]
#[ApiResource]
class Lobby
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Numero = null;

    #[ORM\ManyToOne(inversedBy: 'lobbys')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partie $partie = null;
    #[ORM\OneToMany(mappedBy: 'lobby', targetEntity: ResultatPartie::class, orphanRemoval: true)]
    private Collection $resultats;

    public function __construct()
    {
        $this->resultats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->Numero;
    }

    public function setNumero(int $Numero): static
    {
        $this->Numero = $Numero;

        return $this;
    }

    public function getPartie(): ?Partie
    {
        return $this->partie;
    }

    public function setPartie(?Partie $partie): Lobby
    {
        $this->partie = $partie;
        return $this;
    }

    /**
     * @return Collection<int, ResultatPartie>
     */
    public function getResultats(): Collection
    {
        return $this->resultats;
    }

    public function addResultat(ResultatPartie $resultat): static
    {
        if (!$this->resultats->contains($resultat)) {
            $this->resultats->add($resultat);
            $resultat->setLobby($this);
        }

        return $this;
    }

    public function removeResultat(ResultatPartie $resultat): static
    {
        if ($this->resultats->removeElement($resultat)) {
            // set the owning side to null (unless already changed)
            if ($resultat->getLobby() === $this) {
                $resultat->setLobby(null);
            }
        }

        return $this;
    }
}
