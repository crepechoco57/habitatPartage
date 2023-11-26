<?php

namespace App\Controller;
use App\Entity\Ad;
use App\Form\PostAdType;
use App\Entity\Ville;
use App\Form\LocationType;
use App\Repository\AdRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    #[Route('/ads', name: 'app_view_ads',methods: ['GET','POST','HEAD'])]
    public function viewAds(AdRepository $adRepository,Request $request): Response
    {
        
        $locationForm = $this->createForm(LocationType::class, null, ['show_submit_button' => true]);
        $ads = $adRepository->findAll();


        if ($request->isMethod('POST')) {
         
            $locationForm->handleRequest($request);
    
            if ($locationForm->isSubmitted() ) {
         
                $codeDepartement = $locationForm->get('departement')->getData()->getCode();
                // dd($codeDepartement);
                $ads = $adRepository->findAdsByCodeDepartement($codeDepartement);
    
                // Redirection vers la route spécifique avec le département
                return $this->redirectToRoute('app_view_ads_byDpt', ['departementId' => $codeDepartement]);
            }
        }
        return $this->render('Ad/view_ads.html.twig', [
            'ads' => $ads,
            'locationForm' => $locationForm->createView(),
        ]);
    
     
    }
    #[Route('/ads/{departementId}', name: 'app_view_ads_byDpt',methods: ['GET','POST','HEAD'])]
    public function viewAdsByDpt($departementId,AdRepository $adRepository): Response
    {
        $ads = $adRepository->findBy(['id'=> $departementId]);
        
        return $this->render('Ad/view_ads_byDpt.html.twig', [
            'ads' => $ads,
        ]);
    }
    //la route est relié a un fichier qui inclu deux formulaires (location et ad)
    #[Route('/post_ad', name: 'app_post_ad',methods: ['GET','POST'])]
    public function postAd(Request $request, ManagerRegistry $doctrine, EventDispatcherInterface $eventDispatcher): Response
    {
        //Pour affichage du formulaire qui filtre les villes par département, relié à ad.js 
        //Js injecte la valeur de la ville séléctionnée dans un input du locationForm et dans un input hidden du adForm
        $locationForm = $this->createForm(LocationType::class);
        //formulaire ad
        $adForm = $this->createForm(PostAdType::class);

        $locationForm->handleRequest($request);
        $adForm->handleRequest($request);

        if ($adForm->isSubmitted() && $adForm->isValid()) {
           //récup de l'id injecté en js dans villeId
            $villeId = $adForm->get('villeId')->getData();
            $entityManager = $doctrine->getManager();
            $ville = $entityManager->getRepository(Ville::class)->findVilleById($villeId);
 
            //persistance des données //cherche dans l'entité ville//celle dont l'id est villeId
            // $ville = $entityManager->getRepository(Ville::class)->find($villeId);
            // $ville = $entityManager->getRepository(Ville::class)->find($villeId);
            $ad = new Ad();
            $ad->setTitle($adForm->get('title')->getData());
            $ad->setText($adForm->get('text')->getData());
            $ad->setVille($ville);

            
            // Persist et flush l'annonce
            $entityManager->persist($ad);
            $entityManager->flush();

            // Dispatch de l'événement
            // $event = new GenericEvent($ad);
            // $eventDispatcher->dispatch($event, 'ad.created');
       
        }

        return $this->render('Ad/post_ad.html.twig', [
            'locationForm' => $locationForm->createView(),
            'adForm' => $adForm->createView(),
            'controller_name' => 'AdController',
        ]);
    }
}