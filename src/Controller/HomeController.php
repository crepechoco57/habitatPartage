<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AdRepository;
use App\Form\AdType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home',methods: ['GET','HEAD'])]
    public function index(Request $request,AdRepository $adRepository): Response
    {
         $ads = $adRepository->findAll();

      
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'ads'=> $ads
        ]);
    }
}
