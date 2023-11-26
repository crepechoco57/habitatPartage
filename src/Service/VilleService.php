<?php

namespace App\Service;
//Décodage JSON du fichier de Villes (nom et code Dpt)
class VilleService
{
    public function filtrerVillesParDepartement($cheminFichierJson, $departement)
    {
        $jsonContent = file_get_contents($cheminFichierJson);
        $data = json_decode($jsonContent, true);

        if (!isset($data['cities'])) {
            throw new \Exception("Le fichier JSON ne contient pas la clé 'cities'.");
        }

        $departementVilles = [];
        //pour tous les cities du json villes , recherche le departement number
        foreach ($data['cities'] as $ville) {
            if (isset($ville['department_number']) && $ville['department_number'] === $departement) {
                
                $departementVilles[] = $ville;
                
            }
        }
        //stocke les villes dont le dpt est passé en parametre
        return $ville;
    }
}
