<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Hebergement;
use App\Entity\Domaine;
use App\Entity\Client;


class AjaxController extends AbstractController
{
    /**
     * @Route("/ajout-hebergement/", name="ajout_hebergement", condition="request.isXmlHttpRequest()")
     */
    public function index(Request $request)
    {
        
        $form = $this->createFormBuilder()
        ->setAction($this->generateUrl('ajout_hebergement'))
        ->add('titre')
            ->add('enregistrer', SubmitType::class)
            ->getForm();
        
            $form->handleRequest($request);
            
        if($form->isSubmitted() && $form->isValid()){
            $titre = $form->getData()['titre'];
            
            $hebergement = new Hebergement();
            $hebergement->setTitre($titre);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($hebergement);
            
            $em->flush();
            
            return new Response('<option value="'.$hebergement->getId().'">'.$hebergement->getTitre().'</option>');
        }
        
        return $this->render('ajax/form_hebergement.html.twig', [
            'form' => $form->createView(),
            ]);
    }
            
        /**
        * @Route("/ajout-domaine/", name="ajout_domaine", condition="request.isXmlHttpRequest()")
        */
        public function addDomaine(Request $request, $id)
        {
                    
            $form = $this->createFormBuilder()
                ->setAction($this->generateUrl('ajout_domaine'))
                ->add('titre')
                ->add('enregistrer', SubmitType::class)
                ->getForm();
                    
            $form->handleRequest($request);
                    
            if($form->isSubmitted() && $form->isValid()){
                $titre = $form->getData()['titre'];
                $domaine = new Domaine();

                $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
                $client->addDomaine($domaine);
                
                $domaine->setTitre($titre);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($domaine);
                
                $em->flush();
                
                return new Response('<option value="'.$domaine->getId().'">'.$domaine->getTitre().'</option>');
            }
            
            return $this->render('ajax/form_domaine.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    
}
