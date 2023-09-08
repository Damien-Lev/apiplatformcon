<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConcessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ConcessionRepository::class)]
#[ApiResource]
class Concession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('vehicule')]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Groups('vehicule')]
    private ?string $codeInterne = null;

    #[ORM\Column(length: 255)]
    #[Groups('vehicule')]
    private ?string $libelleAffichage = null;

    #[ORM\ManyToMany(targetEntity: Marque::class, inversedBy: 'concessions')]
    private Collection $marques;

    #[ORM\Column(length: 255)]
    #[Groups('vehicule')]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    #[Groups('vehicule')]
    private ?string $ville = null;

    #[ORM\Column(length: 20)]
    #[Groups('vehicule')]
    private ?string $codePostal = null;

    #[ORM\OneToMany(mappedBy: 'concession', targetEntity: Vehicule::class, orphanRemoval: true)]
    private Collection $vehicules;

    #[ORM\ManyToOne(inversedBy: 'concessions')]
    #[Groups('vehicule')]
    private ?Region $region = null;

    public function __construct()
    {
        $this->marques = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeInterne(): ?string
    {
        return $this->codeInterne;
    }

    public function setCodeInterne(string $codeInterne): static
    {
        $this->codeInterne = $codeInterne;

        return $this;
    }

    public function getLibelleAffichage(): ?string
    {
        return $this->libelleAffichage;
    }

    public function setLibelleAffichage(string $libelleAffichage): static
    {
        $this->libelleAffichage = $libelleAffichage;

        return $this;
    }

    /**
     * @return Collection<int, Marque>
     */
    public function getMarques(): Collection
    {
        return $this->marques;
    }

    public function addMarque(Marque $marque): static
    {
        if (!$this->marques->contains($marque)) {
            $this->marques->add($marque);
        }

        return $this;
    }

    public function removeMarque(Marque $marque): static
    {
        $this->marques->removeElement($marque);

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): static
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setConcession($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): static
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getConcession() === $this) {
                $vehicule->setConcession(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }
}
