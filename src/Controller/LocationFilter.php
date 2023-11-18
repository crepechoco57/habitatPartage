<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Repository\VilleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request; // Correction ici
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocationFilter extends AbstractController
{
    #[Route('/location', name: 'app_location')]
    public function index(ManagerRegistry $doctrine, Request $request, VilleRepository $VilleRepository): Response // Correction ici
    {
        $repository = $doctrine->getRepository(Departement::class);
        $departements = $repository->findAll();

        $villes = $VilleRepository->findAll();

        return $this->render('location/location.html.twig', [
            'departements' => $departements,
            'villes' => $villes
        ]);
    }
}
