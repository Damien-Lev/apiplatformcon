<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
#[ApiResource]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\OneToMany(mappedBy: 'saison', targetEntity: Manche::class, orphanRemoval: true)]
    private Collection $manches;

    #[ORM\ManyToMany(targetEntity: Joueur::class, mappedBy: 'saisons')]
    private Collection $joueurs;

    #[ORM\Column(length: 255)]
    private string $state = 'prevue';

    public function __construct()
    {
        $this->manches = new ArrayCollection();
        $this->joueurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * @return Collection<int, Manche>
     */
    public function getManches(): Collection
    {
        return $this->manches;
    }

    public function addManch(Manche $manch): static
    {
        if (!$this->manches->contains($manch)) {
            $this->manches->add($manch);
            $manch->setSaison($this);
        }

        return $this;
    }

    public function removeManch(Manche $manch): static
    {
        if ($this->manches->removeElement($manch)) {
            // set the owning side to null (unless already changed)
            if ($manch->getSaison() === $this) {
                $manch->setSaison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): static
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
            $joueur->addSaison($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): static
    {
        if ($this->joueurs->removeElement($joueur)) {
            $joueur->removeSaison($this);
        }

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }
}
