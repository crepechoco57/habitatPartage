<?php

namespace App\Controller;

use App\Form\LocationType;
use App\Entity\Departement;

use App\Repository\VilleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocationFilter extends AbstractController
{
    #[Route('/location', name: 'app_location')]
    public function index(ManagerRegistry $doctrine, Request $request, VilleRepository $VilleRepository): Response // Correction ici
    {
        //cherche tous les dpts et toutes les villes
        $repository = $doctrine->getRepository(Departement::class);
        $departements = $repository->findAll();

        $villes = $VilleRepository->findAll();
        dd($villes);
        $form = $this->createForm(LocationType::class);
        
        return $this->render('location/location.html.twig', [
            'departements' => $departements,
            'villes' => $villes,
            'form' => $form->createView()
        ]);
    }
}
