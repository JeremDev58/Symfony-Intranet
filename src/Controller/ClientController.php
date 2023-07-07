<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use App\Entity\Contact;
use App\Form\ClientType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CreationClientType;
use App\Entity\Domaine;
use App\Entity\Projet;
use App\Form\ContactType;
use App\Form\ProjetType;
use App\Entity\Hebergement;
use App\Form\HebergementType;

class ClientController extends AbstractController
{
    /**
     * @Route("/clients/", name="clients")
     */
    public function index()
    {

        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }


    /**
     * @Route("/clients/add/", name="add_client")
     */
    public function addClient(Request $request)
    {

        $client = new Client();

        $contact = new Contact();
        $domaine = new Domaine();
        $projet = new Projet();

        $client->addContact($contact);
        $client->addDomaine($domaine);
        $client->addProjet($projet);

        $form = $this->createForm(CreationClientType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $client = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();

            $em->persist($client);
            $em->flush();

            //
            // On ajoute le projet au domaine
            $projet = $client->getProjets()[0];
            $domaine = $client->getDomaines()[0];

            $domaine->setProjet($projet);

            $em->persist($domaine);
            $em->flush();

            return $this->redirectToRoute('clients');
        }

        return $this->render('client/add_client.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/clients/update/{id}/", name="update_client", requirements={"id"="\d+"})
     */
    public function updateClient($id, Request $request)
    {

        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $client = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();

            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('fiche_client', array('id' => $id));
        }

        return $this->render('client/form_client.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/clients/delete/{id}/", name="delete_clients", requirements={"id"="\d+"})
     */
    public function deleteClient($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);

        if($client) {
            $em->remove($client);
            $em->flush();

            return $this->redirectToRoute('clients');
        }


        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    /**
     * @Route("/clients/fiche/{id}/", name="fiche_client", requirements={"id"="\d+"})
     */
    public function view($id, Request $request)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        
        $nb_visites = ((int)$client->getNbVisites())+1;
        $client->setNbVisites($nb_visites);
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($client);
        
        $em->flush();

        return $this->render('client/view_client.html.twig', [
            'client' => $client,
        ]);
    }
    
    
    /**
     * @Route("/clients/fiche/{id}/add-contact/", name="add_contact", requirements={"id"="\d+"})
     */
    public function addContact($id, Request $request)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        
        $contact = new Contact();
        $contact->setClient($client);
        
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            
            $em->persist($contact);
            $em->flush();
            
            return $this->redirectToRoute('fiche_client', array('id' => $id));
        }
        

        return $this->render('client/form_contact.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }
    
    
    /**
     * @Route("/clients/fiche/{id}/update-contact/{id_contact}/", name="update_contact", requirements={"id"="\d+","id_contact"="\d+"})
     */
    public function updateContact($id, $id_contact, Request $request)
    {
        
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id_contact);
        
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            
            $em->persist($contact);
            $em->flush();
            
            return $this->redirectToRoute('fiche_client', array('id' => $id));
        }
        

        return $this->render('client/form_contact.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
            'modif' => true,
        ]);
    }
    
    
    /**
     * @Route("/clients/fiche/{id}/delete-contact/{id_contact}/", name="delete_contact", requirements={"id"="\d+","id_contact"="\d+"})
     */
    public function deleteContact($id, $id_contact, Request $request)
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id_contact);
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($contact);
        $em->flush();
        
        return $this->redirectToRoute('fiche_client', array('id' => $id));
    }

    
    /**
     * @Route("/clients/fiche/{id}/add-projet/", name="add_projet", requirements={"id"="\d+"})
     */
    public function addProjet($id, Request $request)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        $projet = new Projet();
        
        $projet->setClient($client);
        
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $projet = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            
            $em->persist($projet);
            $em->flush();
            
            return $this->redirectToRoute('fiche_client', array('id' => $id));
        }
        
        return $this->render('client/form_projet.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
            'modif' => true,
        ]);
        
    }
    
    
    /**
     * @Route("/clients/fiche/{id}/update-projet/{id_projet}/", name="update_projet", requirements={"id"="\d+","id_projet"="\d+"})
     */
    public function updateProjet($id, $id_projet, Request $request)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        $projet = $this->getDoctrine()->getRepository(Projet::class)->find($id_projet);
        
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $projet = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            
            $em->persist($projet);
            $em->flush();
            
            return $this->redirectToRoute('fiche_client', array('id' => $id));
        }
        
        return $this->render('client/form_projet.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
            'modif' => true,
        ]);
        
    }
    
    /**
     * @Route("/clients/fiche/{id}/delete-projet/{id_projet}/", name="delete_projet", requirements={"id"="\d+","id_projet"="\d+"})
     */
    public function deleteProjet($id, $id_projet, Request $request)
    {
        $projet = $this->getDoctrine()->getRepository(Projet::class)->find($id_projet);
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($projet);
        $em->flush();
        
        return $this->redirectToRoute('fiche_client', array('id' => $id));
    }

}
