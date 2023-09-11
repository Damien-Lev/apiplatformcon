<?php

namespace App\MaterializedView;

class MeilleuresVentesOptionsDescription
{
    final const QUERY =
        '
        SELECT * FROM (
            SELECT  r.id as region_id,
            o.id as option_id,
            o.code as option_code,
            o.libelle as option_libelle,
            count(o.id) as somme,
            rank() OVER (
                PARTITION BY r.id
                ORDER BY count(o.id) DESC
                ) as rank
        FROM
            vehicule v
                JOIN concession c on v.concession_id = c.id
                JOIN region r on c.region_id = r.id
                JOIN vehicule_option vo on vo.vehicule_id = v.id
                JOIN option o on vo.option_id = o.id
        WHERE v.state = \'vendu\'
        GROUP BY
            r.id,
            o.id,
            o.code,
            o.libelle
            ) agrregate WHERE rank <= 3
        ';

    final const TABLE_NAME =  'v_meilleures_ventes_options';

    final const UNIQUE_INDEX_FIELD = 'region_id, option_id';
}
