<?php

namespace App\MaterializedView;

use App\Tech\View\MaterializedViewDescriptionInterface;

class ClassementSaisonDescription implements MaterializedViewDescriptionInterface
{
    public function getQuery(): string
    {
        return '
        SELECT
            j.id as id,
            j.pseudo as pseudo,
            e.id as equipe_id,
            SUM(rp.points) as points,
            SUM(CASE WHEN rp.place = 1 THEN 1 ELSE 0 END) as nb_top1,
            SUM(CASE WHEN rp.place BETWEEN 1 AND 4 THEN 1 ELSE 0 END) as nb_top4
        FROM
            saison s JOIN manche m on m.saison_id = s.id
            JOIN partie p on p.manche_id = m.id
            JOIN lobby l on l.partie_id = p.id
            JOIN resultat_partie rp on rp.lobby_id = l.id
            JOIN joueur j on rp.joueur_id = j.id
            JOIN equipe e on j.equipe_id = e.id
        /*WHERE s.state = \'en_cours\'*/
        GROUP BY j.id, j.pseudo, e.id
        ORDER BY points DESC, nb_top1 DESC, nb_top4 DESC
        ';
    }

    public function getViewTableName(): string
    {
        return 'v_classement_saison';
    }

    public function getUniqIndexField(): string
    {
        return 'id';
    }
}
