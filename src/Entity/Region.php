<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('vehicule')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('vehicule')]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Concession::class)]
    private Collection $concessions;

    public function __construct()
    {
        $this->concessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $concession->setRegion($this);
        }

        return $this;
    }

    public function removeConcession(Concession $concession): static
    {
        if ($this->concessions->removeElement($concession)) {
            // set the owning side to null (unless already changed)
            if ($concession->getRegion() === $this) {
                $concession->setRegion(null);
            }
        }

        return $this;
    }
}
