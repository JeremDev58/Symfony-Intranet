<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hebergement;
use App\Form\HebergementType;
use Symfony\Component\HttpFoundation\Request;

class HebergementController extends AbstractController
{
    /**
     * @Route("/hebergements/", name="hebergements")
     */
    public function index()
    {
        $hebergements = $this->getDoctrine()->getRepository(Hebergement::class)->findAll();
        
        return $this->render('hebergement/index.html.twig', [
            'hebergements' => $hebergements,
        ]);
    }
    
    
    /**
     * @Route("/add-hebergements/", name="add_hebergement")
     */
    public function addHebergement(Request $request)
    {
        
        $hebergement = new Hebergement();
        
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $hebergement = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            
            $em->persist($hebergement);
            $em->flush();
            
            return $this->redirectToRoute('hebergements');
        }
        
        return $this->render('hebergement/form_hebergement.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/update-hebergement/{id}/", name="update_hebergement", requirements={"id"="\d+"})
     */
    public function updateHebergement($id, Request $request)
    {
        
        $id_client = (int)$request->get('id_client');
        
        $hebergement = $this->getDoctrine()->getRepository(Hebergement::class)->find($id);
        
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $hebergement = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            
            $em->persist($hebergement);
            $em->flush();
            
            if($id_client > 0){
                return $this->redirectToRoute('fiche_client', array('id' => $id_client));
            }else{
                return $this->redirectToRoute('hebergements');
            }
        }
        
        return $this->render('hebergement/form_hebergement.html.twig', [
            'form' => $form->createView(),
            'modif' => true,
        ]);
    }
    
    
    /**
     * @Route("/delete-hebergement/{id}/", name="delete_hebergement", requirements={"id"="\d+"})
     */
    public function deleteHebergement($id, Request $request)
    {
        
        $hebergement = $this->getDoctrine()->getRepository(Hebergement::class)->find($id);
        
        $em = $this->getDoctrine()->getEntityManager();
            
        $em->remove($hebergement);
        $em->flush();
        
        return $this->redirectToRoute('hebergements');
    }
}
