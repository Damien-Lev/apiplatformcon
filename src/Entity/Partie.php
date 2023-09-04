<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
#[ApiResource]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manche $manche = null;

    #[ORM\Column(length: 255)]
    private string $state = 'prevue';

    #[ORM\OneToMany(mappedBy: 'partie', targetEntity: Lobby::class, orphanRemoval: true)]
    private Collection $lobbys;

    public function __construct()
    {
        $this->lobbys = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getManche(): ?Manche
    {
        return $this->manche;
    }

    public function setManche(?Manche $manche): static
    {
        $this->manche = $manche;

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

    /**
     * @return Collection<int, Partie>
     */
    public function getLobbys(): Collection
    {
        return $this->lobbys;
    }

    public function addLobby(Lobby $lobby): static
    {
        if (!$this->lobbys->contains($lobby)) {
            $this->lobbys->add($lobby);
            $lobby->setPartie($this);
        }

        return $this;
    }

    public function removeLobby(Lobby $lobby): static
    {
        if ($this->lobbys->removeElement($lobby)) {
            // set the owning side to null (unless already changed)
            if ($lobby->getPartie() === $this) {
                $lobby->setPartie(null);
            }
        }

        return $this;
    }
}
