<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\ApiResource\View\ClassementSaison;
use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
#[ApiResource]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'equipe', targetEntity: Joueur::class)]
    private Collection $joueurs;

    #[ORM\OneToMany(mappedBy: 'equipe', targetEntity: ClassementSaison::class)]
    private Collection $classements;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
        $this->classements = new ArrayCollection();
    }

    public function setId(?int $id): Equipe
    {
        $this->id = $id;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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
            $joueur->setEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): static
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getEquipe() === $this) {
                $joueur->setEquipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ClassementSaison>
     */
    public function getClassements(): Collection
    {
        return $this->classements;
    }

    public function addClassement(ClassementSaison $classement): static
    {
        if (!$this->classements->contains($classement)) {
            $this->classements->add($classement);
            $classement->setEquipe($this);
        }

        return $this;
    }

    public function removeClassement(ClassementSaison $classement): static
    {
        if ($this->classements->removeElement($classement)) {
            // set the owning side to null (unless already changed)
            if ($classement->getEquipe() === $this) {
                $classement->setEquipe(null);
            }
        }

        return $this;
    }
}
