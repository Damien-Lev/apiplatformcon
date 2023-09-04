<?php

namespace App\Provider\ClassementSaison;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\View\ClassementSaison;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClassementSaisonEquipeWithoutViewProvider implements ProviderInterface
{

    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly EquipeRepository $equipeRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        return array_map(fn ($array) => (
            new ClassementSaison())
            ->setId($array['id'])
            ->setPoints($array['points'])
            ->setPseudo($array['pseudo'])
            ->setNbTop1($array['nb_top1'])
            ->setNbTop4($array['nb_top4'])
            ,$this->entityManager->getConnection()->executeQuery(

                '
                SELECT
                    j.id,
                    j.pseudo,
                    e.id,
                    SUM(rp.points) as points,
                    SUM(CASE WHEN rp.place = 1 THEN 1 ELSE 0 END) as nb_top1,
                    SUM(CASE WHEN rp.place BETWEEN 1 AND 4 THEN 1 ELSE 0 END) as nb_top4
                FROM saison s JOIN manche m on m.saison_id = s.id
                JOIN partie p on p.manche_id = m.id
                JOIN lobby l on l.partie_id = p.id
                JOIN resultat_partie rp on rp.lobby_id = l.id
                JOIN joueur j on rp.joueur_id = j.id
                JOIN equipe e on j.equipe_id = e.id
                WHERE e.id = ?
                GROUP BY j.id, j.pseudo, e.id
                ORDER BY points DESC, nb_top1 DESC, nb_top4 DESC
                ', [$uriVariables['id']]

        )->fetchAllAssociative());
    }
}
