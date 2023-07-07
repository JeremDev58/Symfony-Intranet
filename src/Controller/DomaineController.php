<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Domaine;
use App\Entity\Client;
use App\Form\DomaineType;
use App\Service\DomaineService;

class DomaineController extends AbstractController
{
    /**
     * @Route("/clients/fiche/{id}/add-domaine", name="add_domaine", requirements={"id"="\d+"})
     */
    public function index(Request $request, $id, DomaineService $service)
    {
         $client = $this->getDoctrine()->getRepository(Client::class)->find($id);

         $domaine = new Domaine;
         $domaine->setClient($client);

         $form = $this->createForm(DomaineType::class, $domaine);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid())
         {

              $domaine = $form->getData();
              $em = $this->getDoctrine()->getEntityManager();
              $em->persist($domaine);
              $em->flush();

              if ($domaine->geVhost()) {
                   $service->genererHosts($domaine->getId());
              }

              return $this->redirectToRoute('fiche_client', array('id' => $id));

         }

         return $this->render('domaine/index.html.twig', [
            'controller_name' => 'DomaineController',
            'form' => $form->createView(),
        ]);
    }
}
