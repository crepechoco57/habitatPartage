<?php

// src/Controller/VillesJsonControlleurController.php

namespace App\Controller;

use App\Form\VilleSearchType;
use App\Service\VilleService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VillesJsonControlleurController extends AbstractController
{
    #[Route('/villesJson', name: 'app_villesJson')]
    public function getVillesByDepartement(Request $request, VilleService $villeService)
    {
        //formulaire qui affiche tous départements et retiens le code dpt
        $form = $this->createForm(VilleSearchType::class);
        $form->handleRequest($request);
        $villes=[];

        if ($form->isSubmitted() && $form->isValid()) {
            $departement = $form->get('departement')->getData();
            $cheminFichierJson = $this->getParameter('kernel.project_dir') . '/public/cities.json';
            $villes = $villeService->filtrerVillesParDepartement($cheminFichierJson, $departement);
        }
        return $this->render('ville/ville_par_departement.html.twig', [
            'form' => $form->createView(),
            //pour affichage villes trouvées après formulaire
            'villes' => $villes,
        ]);
    }

}
//requete complexe : chercher les villes dont les dpts = :

