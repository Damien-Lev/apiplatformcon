<?php

namespace App\ApiResource\View;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\MaterializedView\CompteursDashboardDescription;
use App\Tech\View\Attribute\MaterializedView;
use App\Tech\View\MaterializedViewInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: CompteursDashboardDescription::TABLE_NAME)]
#[MaterializedView(
    query: CompteursDashboardDescription::QUERY,
    viewTableName: CompteursDashboardDescription::TABLE_NAME,
    uniqueIndexField: CompteursDashboardDescription::UNIQUE_INDEX_FIELD
)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(
            mercure: true
        )
    ],
)]
class CompteursDashboard implements MaterializedViewInterface
{
    #[ORM\Id]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private string $name;

    #[ORM\Column]
    private int $value;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CompteursDashboard
    {
        $this->name = $name;
        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): CompteursDashboard
    {
        $this->value = $value;
        return $this;
    }


}
