<?php

namespace App\ApiResource\View;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use App\Entity\Equipe;
use App\MaterializedView\ClassementSaisonDescription;
use App\Provider\ClassementSaison\ClassementSaisonEquipeWithoutViewProvider;
use App\Repository\ClassementSaisonRepository;
use App\Tech\View\Attribute\MaterializedView;
use App\Tech\View\MaterializedViewInterface;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Serializer\Annotation\Groups;

#[Entity(repositoryClass: ClassementSaisonRepository::class, readOnly: true)]
#[Table(name: 'v_classement_saison')]
#[MaterializedView(ClassementSaisonDescription::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new GetCollection(
            uriTemplate: '/equipe/{id}/classement_saisons',
            uriVariables: [
                'id' => new Link(
                    fromProperty: 'classements',
                    fromClass: Equipe::class
                )
            ],
        ),
        new GetCollection(
            uriTemplate: '/equipe/{id}/classement_saisons_sans_view',
            uriVariables: [
                'id' => new Link(
                    fromProperty: 'classements',
                    fromClass: Equipe::class
                )
            ],
            provider: ClassementSaisonEquipeWithoutViewProvider::class
        )
    ],
    normalizationContext: [
        'groups' => 'classement_saison'
    ],
    order: ['points' => 'DESC']
)]
class ClassementSaison implements MaterializedViewInterface
{
    #[Id]
    #[Column]
    #[ApiProperty(identifier: true)]
    #[Groups('classement_saison')]
    private ?int $id = null;
    #[Column(length: 255)]
    #[Groups('classement_saison')]
    private string $pseudo;
    #[Column(length: 255)]
    #[Groups('classement_saison')]
    private int $points;

    #[Column()]
    #[Groups('classement_saison')]
    private int $nbTop1;

    #[Column()]
    #[Groups('classement_saison')]
    private int $nbTop4;

    #[ManyToOne(inversedBy: 'classements')]
    #[JoinColumn(nullable: false)]
    private Equipe $equipe;

    public function __construct()
    {
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): ClassementSaison
    {
        $this->id = $id;
        return $this;
    }


    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): ClassementSaison
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): ClassementSaison
    {
        $this->points = $points;
        return $this;
    }

    public function getNbTop1(): int
    {
        return $this->nbTop1;
    }

    public function setNbTop1(int $nbTop1): ClassementSaison
    {
        $this->nbTop1 = $nbTop1;
        return $this;
    }

    public function getNbTop4(): int
    {
        return $this->nbTop4;
    }

    public function setNbTop4(int $nbTop4): ClassementSaison
    {
        $this->nbTop4 = $nbTop4;
        return $this;
    }

    public function getEquipe(): Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(Equipe $equipe): ClassementSaison
    {
        $this->equipe = $equipe;
        return $this;
    }
}
