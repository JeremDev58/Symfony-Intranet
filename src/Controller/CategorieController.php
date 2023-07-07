<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends AbstractController
{
    
    /**
     * @Route("/categories/", name="categories")
     */
    public function index()
    {        
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    
    
    /**
     * @Route("/categories/new/", name="add_categorie")
     */
    public function addCategorie(Request $request)
    {
        
        $categorie = new Categorie();
        
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $categorie = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            
            $em->persist($categorie);
            $em->flush();
            
            return $this->redirectToRoute('categories');
        }
        
        return $this->render('categorie/add_categorie.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    
    /**
     * @Route("/categories/update/{id}/", name="update_categorie", requirements={"id"="\d+"})
     */
    public function updateCategorie($id, Request $request)
    {
        
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
        
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $categorie = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            
            $em->persist($categorie);
            $em->flush();
            
            return $this->redirectToRoute('categories');
        }
        
        return $this->render('categorie/add_categorie.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
