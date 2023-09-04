<?php

declare(strict_types=1);

namespace App\Tech\View\Attribute;

use App\Tech\View\MaterializedViewDescriptionInterface;
use Attribute;
use Exception;

#[Attribute(Attribute::TARGET_CLASS)]
class MaterializedView
{
    private ?MaterializedViewDescriptionInterface $descriptionClass = null;
    /**
     * @throws Exception
     */
    public function __construct(
        public readonly string $descriptionClassName
    ) {
        $class = new $this->descriptionClassName();
        if (!($class instanceof MaterializedViewDescriptionInterface)) {
            throw new Exception(sprintf('Class must % implement %', $this->descriptionClassName, MaterializedViewDescriptionInterface::class));
        }
        $this->setDescriptionClass($class);
    }

    public function getDescriptionClass(): ?MaterializedViewDescriptionInterface
    {
        return $this->descriptionClass;
    }

    public function setDescriptionClass(?MaterializedViewDescriptionInterface $descriptionClass): MaterializedView
    {
        $this->descriptionClass = $descriptionClass;
        return $this;
    }


}
