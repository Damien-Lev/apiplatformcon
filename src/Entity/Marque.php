<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('vehicule')]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Groups('vehicule')]
    private ?string $code = null;

    #[ORM\Column(length: 50)]
    #[Groups('vehicule')]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Option::class, orphanRemoval: true)]
    private Collection $options;

    #[ORM\ManyToMany(targetEntity: Concession::class, mappedBy: 'marques')]
    private Collection $concessions;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Vehicule::class, orphanRemoval: true)]
    private Collection $vehicules;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Modele::class, orphanRemoval: true)]
    private Collection $modeles;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->concessions = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
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

    /**
     * @return Collection<int, Option>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): static
    {
        if (!$this->options->contains($option)) {
            $this->options->add($option);
            $option->setMarque($this);
        }

        return $this;
    }

    public function removeOption(Option $option): static
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getMarque() === $this) {
                $option->setMarque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Concession>
     */
    public function getConcessions(): Collection
    {
        return $this->concessions;
    }

    public function addConcession(Concession $concession): static
    {
        if (!$this->concessions->contains($concession)) {
            $this->concessions->add($concession);
            $concession->addMarque($this);
        }

        return $this;
    }

    public function removeConcession(Concession $concession): static
    {
        if ($this->concessions->removeElement($concession)) {
            $concession->removeMarque($this);
        }

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
            $vehicule->setMarque($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): static
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getMarque() === $this) {
                $vehicule->setMarque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Modele>
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): static
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles->add($modele);
            $modele->setMarque($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): static
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getMarque() === $this) {
                $modele->setMarque(null);
            }
        }

        return $this;
    }
}
