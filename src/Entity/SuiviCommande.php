<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SuiviCommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SuiviCommandeRepository::class)]
#[ApiResource]
class SuiviCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('vehicule')]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'suiviCommande', cascade: ['persist', 'remove'])]
    private ?Vehicule $vehicule = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups('vehicule')]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups('vehicule')]
    private ?\DateTimeInterface $dateReceptionCommande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups('vehicule')]
    private ?\DateTimeInterface $dateDebutConstruction = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups('vehicule')]
    private ?\DateTimeInterface $dateFinConstruction = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups('vehicule')]
    private ?\DateTimeInterface $dateDepartUsine = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups('vehicule')]
    private ?\DateTimeInterface $dateReceptionConcession = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(Vehicule $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getDateReceptionCommande(): ?\DateTimeInterface
    {
        return $this->dateReceptionCommande;
    }

    public function setDateReceptionCommande(?\DateTimeInterface $dateReceptionCommande): static
    {
        $this->dateReceptionCommande = $dateReceptionCommande;

        return $this;
    }

    public function getDateDebutConstruction(): ?\DateTimeInterface
    {
        return $this->dateDebutConstruction;
    }

    public function setDateDebutConstruction(?\DateTimeInterface $dateDebutConstruction): static
    {
        $this->dateDebutConstruction = $dateDebutConstruction;

        return $this;
    }

    public function getDateFinConstruction(): ?\DateTimeInterface
    {
        return $this->dateFinConstruction;
    }

    public function setDateFinConstruction(?\DateTimeInterface $dateFinConstruction): static
    {
        $this->dateFinConstruction = $dateFinConstruction;

        return $this;
    }

    public function getDateDepartUsine(): ?\DateTimeInterface
    {
        return $this->dateDepartUsine;
    }

    public function setDateDepartUsine(?\DateTimeInterface $dateDepartUsine): static
    {
        $this->dateDepartUsine = $dateDepartUsine;

        return $this;
    }

    public function getDateReceptionConcession(): ?\DateTimeInterface
    {
        return $this->dateReceptionConcession;
    }

    public function setDateReceptionConcession(?\DateTimeInterface $dateReceptionConcession): static
    {
        $this->dateReceptionConcession = $dateReceptionConcession;

        return $this;
    }
}
