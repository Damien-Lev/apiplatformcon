<?php

declare(strict_types=1);

namespace App\Tech\View\Attribute;

use App\Tech\View\MaterializedViewDescriptionInterface;
use Attribute;
use Exception;

#[Attribute(Attribute::TARGET_CLASS)]
class MaterializedView
{
    public function __construct(protected string $query, protected string $viewTableName, protected string $uniqueIndexField)
    {
    }
}
