<?php

namespace App\MaterializedView;

class TableauVehiculesDescription
{
    final const QUERY =
        '
        SELECT
            v.id as id,
            v.state as state,
            v.car as car,
            v.vin as vin,
            ca.id as categorie_id,
            ca.code as categorie_code,
            co.id as concession_id,
            co.code_interne as concession_code_interne,
            co.libelle_affichage as concession_libelle_affichage,
            co.adresse as concession_adresse,
            co.ville as concession_ville,
            co.code_postal as concession_code_postal,
            reg.id as region_id,
            reg.libelle as region_libelle,
            ma.id as marque_id,
            ma.code as marque_code,
            ma.libelle as marque_libelle,
            CASE
                WHEN sum(o.id) = 0 THEN \'[]\'
                ELSE \'[{"\' || STRING_AGG(o.code || \'":"\' || o.libelle,\'"},{"\') ||\'"}]\'
            END as options,
            sc.id as suivi_commande_id,
            TO_CHAR(sc.date_commande,\'dd/mm/yyyy\') as suivi_commande_date_commande,
            TO_CHAR(sc.date_reception_commande,\'dd/mm/yyyy\') as suivi_commande_date_reception_commande,
            TO_CHAR(sc.date_debut_construction,\'dd/mm/yyyy\') as suivi_commande_date_debut_construction,
            TO_CHAR(sc.date_fin_construction,\'dd/mm/yyyy\') as suivi_commande_date_fin_construction,
            TO_CHAR(sc.date_depart_usine,\'dd/mm/yyyy\') as suivi_commande_date_depart_usine,
            TO_CHAR(sc.date_reception_concession,\'dd/mm/yyyy\') as suivi_commande_date_reception_concession,
            res.id as reservation_id,
            TO_CHAR(res.date_demande,\'dd/mm/yyyy\') as reservation_date_demande,
            cl.id as client_id,
            cl.nom as client_nom,
            cl.prenom as client_prenom,
            cl.adresse as client_adresse,
            cl.code_postal as client_code_postal,
            cl.ville as client_ville,
            cl.telephone as client_telephone,
            cl.email as client_email,
            mo.id as modele_id,
            mo.libelle as modele_libelle

        FROM
            vehicule v
            inner join categorie ca on v.categorie_id = ca.id
            inner join concession co on v.concession_id = co.id
            inner join region reg on co.region_id = reg.id
            inner join marque ma on v.marque_id = ma.id
            inner join suivi_commande sc on v.suivi_commande_id = sc.id
            inner join modele mo on v.modele_id = mo.id
            left join vehicule_option vo on vo.vehicule_id = v.id
            left join option o on vo.option_id = o.id
            left join reservation res on res.vehicule_id = v.id AND res.en_cours = TRUE
            left join client cl on res.client_id = cl.id
        GROUP BY
            v.id,
            ca.id,
            ca.code,
            co.id,
            co.code_interne,
            co.libelle_affichage,
            co.adresse,
            co.ville,
            co.code_postal,
            reg.id,
            reg.libelle,
            ma.id,
            ma.code,
            ma.libelle,
            sc.id,
            sc.date_commande,
            sc.date_reception_commande,
            sc.date_debut_construction,
            sc.date_fin_construction,
            sc.date_depart_usine,
            sc.date_reception_concession,
            res.id,
            res.date_demande,
            cl.id,
            cl.nom,
            cl.prenom,
            cl.adresse,
            cl.code_postal,
            cl.ville,
            cl.telephone,
            cl.email,
            v.state,
            v.car,
            v.vin,
            mo.id,
            mo.libelle
        ';

    final const TABLE_NAME =  'v_tableau_vehicules';

    final const UNIQUE_INDEX_FIELD = 'id';
}
