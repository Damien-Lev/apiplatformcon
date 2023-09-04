<?php

namespace App\Entity;

use App\Repository\ViewUpdateListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ViewUpdateListRepository::class)]
class ViewUpdateList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $viewName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getViewName(): ?string
    {
        return $this->viewName;
    }

    public function setViewName(string $viewName): static
    {
        $this->viewName = $viewName;

        return $this;
    }
}
