<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use App\MaterializedView\CompteursDescription;
use App\MaterializedView\TableauVehiculesDescription;
use App\Processor\PasserEnStockProcessor;
use App\Repository\VehiculeRepository;
use App\Tech\Api\Listener\KernelRequestListener;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Patch(
            uriTemplate: '/vehicules/{id}/passer-en-stock',
            processor: PasserEnStockProcessor::class,
            extraProperties: [
                KernelRequestListener::VIEW_UPDATE_LIST => [
                    CompteursDescription::TABLE_NAME,
                    TableauVehiculesDescription::TABLE_NAME
                ]
            ]
        )
    ],
    normalizationContext: ['groups' => 'vehicule']
)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('vehicule')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('vehicule')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('vehicule')]
    private ?Concession $concession = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('vehicule')]
    private ?Marque $marque = null;

    #[ORM\ManyToMany(targetEntity: Option::class, inversedBy: 'vehicules')]
    #[Groups('vehicule')]
    private Collection $options;

    #[ORM\OneToOne(inversedBy: 'vehicule', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('vehicule')]
    private ?SuiviCommande $suiviCommande = null;

    #[ORM\OneToMany(mappedBy: 'vehicule', targetEntity: Reservation::class, orphanRemoval: true)]
    #[Groups('vehicule')]
    private Collection $reservations;

    #[ORM\Column(length: 50)]
    #[Groups('vehicule')]
    private ?string $state = 'en_commande';

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('vehicule')]
    private ?Modele $modele = null;

    #[ORM\Column(length: 10)]
    #[Groups('vehicule')]
    private ?string $car = null;

    #[ORM\Column(length: 30)]
    #[Groups('vehicule')]
    private ?string $vin = null;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getConcession(): ?Concession
    {
        return $this->concession;
    }

    public function setConcession(?Concession $concession): static
    {
        $this->concession = $concession;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

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
        }

        return $this;
    }

    public function removeOption(Option $option): static
    {
        $this->options->removeElement($option);

        return $this;
    }

    public function getSuiviCommande(): ?SuiviCommande
    {
        return $this->suiviCommande;
    }

    public function setSuiviCommande(SuiviCommande $suiviCommande): static
    {
        // set the owning side of the relation if necessary
        if ($suiviCommande->getVehicule() !== $this) {
            $suiviCommande->setVehicule($this);
        }

        $this->suiviCommande = $suiviCommande;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setVehicule($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getVehicule() === $this) {
                $reservation->setVehicule(null);
            }
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

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCar(): ?string
    {
        return $this->car;
    }

    public function setCar(string $car): static
    {
        $this->car = $car;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): static
    {
        $this->vin = $vin;

        return $this;
    }
}
