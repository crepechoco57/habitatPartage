<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Entity\Departement;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxController extends AbstractController
{
#[Route('/ajax/villes-by-departement', name: 'ajax_villes_by_departement')]
public function getVillesByDepartement(Request $request, ManagerRegistry $doctrine): JsonResponse
{
    $codeDepartement = $request->request->get('code_departement');
    

    $villeSearch = $request->request->get('ville_search');

    $entityManager = $doctrine->getManager();
    $villeRepository = $entityManager->getRepository(Ville::class);

    $queryBuilder = $villeRepository->createQueryBuilder('v');
    $villes = $queryBuilder
        ->where('v.code_departement = :code_departement')
        ->andWhere($queryBuilder->expr()->like('v.nom', ':ville_search'))
        ->setParameters([
            'code_departement' => $codeDepartement,
            'ville_search' => $villeSearch . '%' 
        ])
        ->getQuery()
        ->getResult();
            
    //Formatage JSON
    $formattedVilles = [];
    foreach ($villes as $ville) {
        $formattedVilles[] = [
            'code_departement' => $ville->getCodeDepartement(),
            'nom' => $ville->getNom(),
            'id' => $ville->getID()
        ];
    }

    return new JsonResponse($formattedVilles);
}
}