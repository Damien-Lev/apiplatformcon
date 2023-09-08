<?php

namespace App\MaterializedView;

class CompteursDescription
{
    final const QUERY =
        '
        WITH somme AS (
            SELECT
                SUM(CASE WHEN v.state = \'en_commande\' THEN 1 ELSE 0 END) as en_commande,
                SUM(CASE WHEN v.state = \'en_stock\' THEN 1 ELSE 0 END) as en_stock,
                SUM(CASE WHEN v.state = \'reserve\' THEN 1 ELSE 0 END) as reserve,
                SUM(CASE WHEN v.state = \'vendu\' THEN 1 ELSE 0 END) as vendu
            FROM vehicule v
        )
        SELECT
            c.name as name,
            CASE
                WHEN c.name = \'en_commande\' THEN COALESCE(somme.en_commande,0)
                WHEN c.name = \'en_stock\' THEN COALESCE(somme.en_stock,0)
                WHEN c.name = \'reserve\' THEN COALESCE(somme.reserve,0)
                WHEN c.name = \'vendu\' THEN COALESCE(somme.vendu,0)
            ELSE 0
            END as value
        FROM
            compteur c, somme
        ';

    final const TABLE_NAME =  'v_compteurs';

    final const UNIQUE_INDEX_FIELD = 'name';
}
