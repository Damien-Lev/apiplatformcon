<?php

namespace App\ApiResource\View;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\MaterializedView\CompteursDescription;
use App\Tech\View\Attribute\MaterializedView;
use App\Tech\View\MaterializedViewInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: CompteursDescription::TABLE_NAME)]
#[MaterializedView(
    query: CompteursDescription::QUERY,
    viewTableName: CompteursDescription::TABLE_NAME,
    uniqueIndexField: CompteursDescription::UNIQUE_INDEX_FIELD
)]
#[ApiResource]
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
