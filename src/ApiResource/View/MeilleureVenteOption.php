<?php

namespace App\ApiResource\View;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\MaterializedView\MeilleuresVentesOptionsDescription;
use App\Tech\View\Attribute\MaterializedView;
use App\Tech\View\MaterializedViewInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: MeilleuresVentesOptionsDescription::TABLE_NAME)]
#[MaterializedView(
    query: MeilleuresVentesOptionsDescription::QUERY,
    viewTableName: MeilleuresVentesOptionsDescription::TABLE_NAME,
    uniqueIndexField: MeilleuresVentesOptionsDescription::UNIQUE_INDEX_FIELD
)]
#[ApiResource(
    operations: [
        new GetCollection(
            mercure: true
        )
    ],
    order: ['regionId' => 'ASC', 'rank' => 'ASC']
)]

class MeilleureVenteOption implements MaterializedViewInterface
{
    #[ORM\Column]
    private int $regionId;

    #[ORM\Column]
    #[ORM\Id]
    #[ApiProperty(identifier: true)]
    private int $optionId;

    #[ORM\Column]
    private string $optionCode;

    #[ORM\Column]
    private string $optionLibelle;

    #[ORM\Column]
    private int $somme;

    #[ORM\Column]
    private int $rank;

    public function getRegionId(): int
    {
        return $this->regionId;
    }

    public function setRegionId(int $regionId): MeilleureVenteOption
    {
        $this->regionId = $regionId;
        return $this;
    }

    public function getOptionId(): int
    {
        return $this->optionId;
    }

    public function setOptionId(int $optionId): MeilleureVenteOption
    {
        $this->optionId = $optionId;
        return $this;
    }

    public function getOptionCode(): string
    {
        return $this->optionCode;
    }

    public function setOptionCode(string $optionCode): MeilleureVenteOption
    {
        $this->optionCode = $optionCode;
        return $this;
    }

    public function getOptionLibelle(): string
    {
        return $this->optionLibelle;
    }

    public function setOptionLibelle(string $optionLibelle): MeilleureVenteOption
    {
        $this->optionLibelle = $optionLibelle;
        return $this;
    }

    public function getSomme(): int
    {
        return $this->somme;
    }

    public function setSomme(int $somme): MeilleureVenteOption
    {
        $this->somme = $somme;
        return $this;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function setRank(int $rank): MeilleureVenteOption
    {
        $this->rank = $rank;
        return $this;
    }


}
