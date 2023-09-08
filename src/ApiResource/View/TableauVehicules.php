<?php

namespace App\ApiResource\View;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\MaterializedView\TableauVehiculesDescription;
use App\Tech\View\Attribute\MaterializedView;
use App\Tech\View\MaterializedViewInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: TableauVehiculesDescription::TABLE_NAME)]
#[MaterializedView(
    query: TableauVehiculesDescription::QUERY,
    viewTableName: TableauVehiculesDescription::TABLE_NAME,
    uniqueIndexField: TableauVehiculesDescription::UNIQUE_INDEX_FIELD
)]
#[ApiResource]
class TableauVehicules implements MaterializedViewInterface
{
    #[ORM\Id]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private int $id;
    #[ORM\Column]
    private ?string $state;
    #[ORM\Column]
    private ?string $car;
    #[ORM\Column]
    private ?string $vin;
    #[ORM\Column]
    private ?int $categorieId;
    #[ORM\Column]
    private ?string $categorieCode;
    #[ORM\Column]
    private ?int $concessionId;
    #[ORM\Column]
    private ?string $concessionCodeInterne;
    #[ORM\Column]
    private ?string $concessionLibelleAffichage;
    #[ORM\Column]
    private ?string $concessionAdresse;
    #[ORM\Column]
    private ?string $concessionVille;
    #[ORM\Column]
    private ?string $concessionCodePostal;
    #[ORM\Column]
    private ?int $regionId;
    #[ORM\Column]
    private ?string $regionLibelle;
    #[ORM\Column]
    private ?int $marqueId;
    #[ORM\Column]
    private ?string $marqueCode;
    #[ORM\Column]
    private ?string $marqueLibelle;
    #[ORM\Column]
    private ?array $options = [];
    #[ORM\Column]
    private ?int $suiviCommandeId;
    #[ORM\Column]
    private ?string $suiviCommandeDateCommande;
    #[ORM\Column]
    private ?string $suiviCommandeDateReceptionCommande;
    #[ORM\Column]
    private ?string $suiviCommandeDateDebutConstruction;
    #[ORM\Column]
    private ?string $suiviCommandeDateFinConstruction;
    #[ORM\Column]
    private ?string $suiviCommandeDateDepartUsine;
    #[ORM\Column]
    private ?string $suiviCommandeDateReceptionConcession;
    #[ORM\Column]
    private ?int $reservationId;
    #[ORM\Column]
    private ?string $reservationDateDemande;
    #[ORM\Column]
    private ?int $clientId;
    #[ORM\Column]
    private ?string $clientNom;
    #[ORM\Column]
    private ?string $clientPrenom;
    #[ORM\Column]
    private ?string $clientAdresse;
    #[ORM\Column]
    private ?string $clientCodePostal;
    #[ORM\Column]
    private ?string $clientVille;
    #[ORM\Column]
    private ?string $clientTelephone;
    #[ORM\Column]
    private ?string $clientEmail;
    #[ORM\Column]
    private ?int $modeleId;
    #[ORM\Column]
    private ?string $modeleLibelle;
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): TableauVehicules
    {
        $this->id = $id;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): TableauVehicules
    {
        $this->state = $state;
        return $this;
    }

    public function getCar(): ?string
    {
        return $this->car;
    }

    public function setCar(?string $car): TableauVehicules
    {
        $this->car = $car;
        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(?string $vin): TableauVehicules
    {
        $this->vin = $vin;
        return $this;
    }

    public function getCategorieId(): ?int
    {
        return $this->categorieId;
    }

    public function setCategorieId(?int $categorieId): TableauVehicules
    {
        $this->categorieId = $categorieId;
        return $this;
    }

    public function getCategorieCode(): ?string
    {
        return $this->categorieCode;
    }

    public function setCategorieCode(?string $categorieCode): TableauVehicules
    {
        $this->categorieCode = $categorieCode;
        return $this;
    }

    public function getConcessionId(): ?int
    {
        return $this->concessionId;
    }

    public function setConcessionId(?int $concessionId): TableauVehicules
    {
        $this->concessionId = $concessionId;
        return $this;
    }

    public function getConcessionCodeInterne(): ?string
    {
        return $this->concessionCodeInterne;
    }

    public function setConcessionCodeInterne(?string $concessionCodeInterne): TableauVehicules
    {
        $this->concessionCodeInterne = $concessionCodeInterne;
        return $this;
    }

    public function getConcessionLibelleAffichage(): ?string
    {
        return $this->concessionLibelleAffichage;
    }

    public function setConcessionLibelleAffichage(?string $concessionLibelleAffichage): TableauVehicules
    {
        $this->concessionLibelleAffichage = $concessionLibelleAffichage;
        return $this;
    }

    public function getConcessionAdresse(): ?string
    {
        return $this->concessionAdresse;
    }

    public function setConcessionAdresse(?string $concessionAdresse): TableauVehicules
    {
        $this->concessionAdresse = $concessionAdresse;
        return $this;
    }

    public function getConcessionVille(): ?string
    {
        return $this->concessionVille;
    }

    public function setConcessionVille(?string $concessionVille): TableauVehicules
    {
        $this->concessionVille = $concessionVille;
        return $this;
    }

    public function getConcessionCodePostal(): ?string
    {
        return $this->concessionCodePostal;
    }

    public function setConcessionCodePostal(?string $concessionCodePostal): TableauVehicules
    {
        $this->concessionCodePostal = $concessionCodePostal;
        return $this;
    }

    public function getRegionId(): ?int
    {
        return $this->regionId;
    }

    public function setRegionId(?int $regionId): TableauVehicules
    {
        $this->regionId = $regionId;
        return $this;
    }

    public function getRegionLibelle(): ?string
    {
        return $this->regionLibelle;
    }

    public function setRegionLibelle(?string $regionLibelle): TableauVehicules
    {
        $this->regionLibelle = $regionLibelle;
        return $this;
    }

    public function getMarqueId(): ?int
    {
        return $this->marqueId;
    }

    public function setMarqueId(?int $marqueId): TableauVehicules
    {
        $this->marqueId = $marqueId;
        return $this;
    }

    public function getMarqueCode(): ?string
    {
        return $this->marqueCode;
    }

    public function setMarqueCode(?string $marqueCode): TableauVehicules
    {
        $this->marqueCode = $marqueCode;
        return $this;
    }

    public function getMarqueLibelle(): ?string
    {
        return $this->marqueLibelle;
    }

    public function setMarqueLibelle(?string $marqueLibelle): TableauVehicules
    {
        $this->marqueLibelle = $marqueLibelle;
        return $this;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): TableauVehicules
    {
        $this->options = $options;
        return $this;
    }

    public function getSuiviCommandeId(): ?int
    {
        return $this->suiviCommandeId;
    }

    public function setSuiviCommandeId(?int $suiviCommandeId): TableauVehicules
    {
        $this->suiviCommandeId = $suiviCommandeId;
        return $this;
    }

    public function getSuiviCommandeDateCommande(): ?string
    {
        return $this->suiviCommandeDateCommande;
    }

    public function setSuiviCommandeDateCommande(?string $suiviCommandeDateCommande): TableauVehicules
    {
        $this->suiviCommandeDateCommande = $suiviCommandeDateCommande;
        return $this;
    }

    public function getSuiviCommandeDateReceptionCommande(): ?string
    {
        return $this->suiviCommandeDateReceptionCommande;
    }

    public function setSuiviCommandeDateReceptionCommande(?string $suiviCommandeDateReceptionCommande): TableauVehicules
    {
        $this->suiviCommandeDateReceptionCommande = $suiviCommandeDateReceptionCommande;
        return $this;
    }

    public function getSuiviCommandeDateDebutConstruction(): ?string
    {
        return $this->suiviCommandeDateDebutConstruction;
    }

    public function setSuiviCommandeDateDebutConstruction(?string $suiviCommandeDateDebutConstruction): TableauVehicules
    {
        $this->suiviCommandeDateDebutConstruction = $suiviCommandeDateDebutConstruction;
        return $this;
    }

    public function getSuiviCommandeDateFinConstruction(): ?string
    {
        return $this->suiviCommandeDateFinConstruction;
    }

    public function setSuiviCommandeDateFinConstruction(?string $suiviCommandeDateFinConstruction): TableauVehicules
    {
        $this->suiviCommandeDateFinConstruction = $suiviCommandeDateFinConstruction;
        return $this;
    }

    public function getSuiviCommandeDateDepartUsine(): ?string
    {
        return $this->suiviCommandeDateDepartUsine;
    }

    public function setSuiviCommandeDateDepartUsine(?string $suiviCommandeDateDepartUsine): TableauVehicules
    {
        $this->suiviCommandeDateDepartUsine = $suiviCommandeDateDepartUsine;
        return $this;
    }

    public function getSuiviCommandeDateReceptionConcession(): ?string
    {
        return $this->suiviCommandeDateReceptionConcession;
    }

    public function setSuiviCommandeDateReceptionConcession(?string $suiviCommandeDateReceptionConcession): TableauVehicules
    {
        $this->suiviCommandeDateReceptionConcession = $suiviCommandeDateReceptionConcession;
        return $this;
    }

    public function getReservationId(): ?int
    {
        return $this->reservationId;
    }

    public function setReservationId(?int $reservationId): TableauVehicules
    {
        $this->reservationId = $reservationId;
        return $this;
    }

    public function getReservationDateDemande(): ?string
    {
        return $this->reservationDateDemande;
    }

    public function setReservationDateDemande(?string $reservationDateDemande): TableauVehicules
    {
        $this->reservationDateDemande = $reservationDateDemande;
        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $clientId): TableauVehicules
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getClientNom(): ?string
    {
        return $this->clientNom;
    }

    public function setClientNom(?string $clientNom): TableauVehicules
    {
        $this->clientNom = $clientNom;
        return $this;
    }

    public function getClientPrenom(): ?string
    {
        return $this->clientPrenom;
    }

    public function setClientPrenom(?string $clientPrenom): TableauVehicules
    {
        $this->clientPrenom = $clientPrenom;
        return $this;
    }

    public function getClientAdresse(): ?string
    {
        return $this->clientAdresse;
    }

    public function setClientAdresse(?string $clientAdresse): TableauVehicules
    {
        $this->clientAdresse = $clientAdresse;
        return $this;
    }

    public function getClientCodePostal(): ?string
    {
        return $this->clientCodePostal;
    }

    public function setClientCodePostal(?string $clientCodePostal): TableauVehicules
    {
        $this->clientCodePostal = $clientCodePostal;
        return $this;
    }

    public function getClientVille(): ?string
    {
        return $this->clientVille;
    }

    public function setClientVille(?string $clientVille): TableauVehicules
    {
        $this->clientVille = $clientVille;
        return $this;
    }

    public function getClientTelephone(): ?string
    {
        return $this->clientTelephone;
    }

    public function setClientTelephone(?string $clientTelephone): TableauVehicules
    {
        $this->clientTelephone = $clientTelephone;
        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(?string $clientEmail): TableauVehicules
    {
        $this->clientEmail = $clientEmail;
        return $this;
    }

    public function getModeleId(): ?int
    {
        return $this->modeleId;
    }

    public function setModeleId(?int $modeleId): TableauVehicules
    {
        $this->modeleId = $modeleId;
        return $this;
    }

    public function getModeleLibelle(): ?string
    {
        return $this->modeleLibelle;
    }

    public function setModeleLibelle(?string $modeleLibelle): TableauVehicules
    {
        $this->modeleLibelle = $modeleLibelle;
        return $this;
    }
}
