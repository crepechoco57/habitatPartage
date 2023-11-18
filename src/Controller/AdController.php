<?php

namespace App\Controller;


use App\Entity\Departement;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    //Dans la route /departement, définition des éléments permettant d'afficher le formulaire
    #[Route('/departement', name: 'app_departement')]
    public function index(ManagerRegistry $doctrine,Request $request): Response
    {
        $repository = $doctrine->getRepository(Departement::class);
        $departements = $repository->findAll();

        return $this->render('post_ad/location.html.twig', [
            'departements' => $departements,
        ]);
    }
   

}
