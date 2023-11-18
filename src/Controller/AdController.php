<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    #[Route('/post_ad', name: 'post_ad',methods: ['GET','HEAD'])]
    public function index(Request $request): Response
    {
        return $this->render('Ad/ad.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }
}
