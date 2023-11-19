<?php

namespace App\Controller;
use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Ville;
use App\Form\LocationType;
use App\Repository\AdRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    #[Route('/ads', name: 'app_viewads')]
    public function viewads(AdRepository $adRepository): Response
    {
        $ads = $adRepository->findAll();

        return $this->render('Ad/viewads.html.twig', [
            'ads' => $ads,
        ]);
    }
    //la route est relié a un fichier qui inclu deux formulaires (location et ad)
    #[Route('/post_ad', name: 'app_post_ad',methods: ['GET','POST'])]
    public function index(Request $request, ManagerRegistry $doctrine, EventDispatcherInterface $eventDispatcher): Response
    {
        //Pour affichage du formulaire qui filtre les villes par département, relié à ad.js 
        //Js injecte la valeur de la ville séléctionnée dans un input du locationForm et dans un input hidden du adForm
        $locationForm = $this->createForm(LocationType::class);
        //formulaire ad
        $adForm = $this->createForm(AdType::class);

        $locationForm->handleRequest($request);
        $adForm->handleRequest($request);

        if ($adForm->isSubmitted() && $adForm->isValid()) {
          //récup de l'id injecté en js dans villeId
            $villeId = $adForm->get('villeId')->getData();

            $entityManager = $doctrine->getManager();
            //persistance des données //cherche dans l'entité ville//celle dont l'id est villeId
            $ville = $entityManager->getRepository(Ville::class)->find($villeId);

            $ad = new Ad();
            $ad->setTitle($adForm->get('title')->getData());
            $ad->setText($adForm->get('text')->getData());
            $ad->setVille($ville);

            // Persist et flush l'annonce
            $entityManager->persist($ad);
            $entityManager->flush();

            // Dispatch de l'événement
            $event = new GenericEvent($ad);
            $eventDispatcher->dispatch($event, 'ad.created');

            // $title = $adForm->get('title')->getData();
            // $ad->setTitle($title);
            // // $ad = $adForm->getData();
            // // Associer l'entité Ville à l'annonce
            // // $ad->setVille($ville);
            // // $ville->addAd($ad);
            // // Persist et flush l'annonce
            // $entityManager = $doctrine->getManager();
            // $entityManager->persist($ad);
            // $entityManager->flush();

            // // Dispatch de l'événement
            // $event = new GenericEvent($ad);
            // $eventDispatcher->dispatch($event, 'ad.created');
        }

        return $this->render('Ad/ad.html.twig', [
            'locationForm' => $locationForm->createView(),
            'adForm' => $adForm->createView(),
            'controller_name' => 'AdController',
        ]);
    }
   
}