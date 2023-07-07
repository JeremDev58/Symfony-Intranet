<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact/", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        //Formulaire de contact
        $form = $this->createFormBuilder()
            ->add('nom', TextType::class, array('label' => 'Nom', 'required' => true))
            ->add('prenom', TextType::class, array('label' => 'Prénom', 'required' => false))
            ->add('adresse', TextType::class, array('label' => 'Adresse', 'required' => false))
            ->add('adresse2', TextType::class, array('label' => ' ', 'required' => false))
            ->add('cp', TextType::class, array('label' => 'Code postal', 'required' => false))
            ->add('ville', TextType::class, array('label' => 'Ville', 'required' => false))
            ->add('pays', TextType::class, array('label' => 'Pays', 'required' => false))
            ->add('tel', TelType::class, array('label' => 'Téléphone', 'required' => true))
            ->add('fax', TelType::class, array('label' => 'Fax', 'required' => false))
            ->add('email', EmailType::class, array('label' => 'Email', 'required' => true))
            ->add('demande', TextareaType::class, array('label' => 'Demande', 'required' => false))
            ->add('submit', SubmitType::class, array('label' => 'Envoyer'))
            ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            
            $message = (new \Swift_Message('Contact via site Internet'))
            ->setFrom($data['email'])
            ->setTo('nicolas@direct-web.fr')
            ->setBody(
                $this->renderView(
                    'contact/contact_form.html.twig',
                    array('data' => $data)
                    ),
                'text/html'
                )
            ;
            
            $mailer->send($message);
            
            return $this->redirectToRoute('contact_merci');
        }
        
        return $this->render('contact/index.html.twig', [
            'form_contact' => $form->createView(),
        ]);
    }
    
    /**
     * 
     * @Route("/contact/merci.html", name="contact_merci")
     */
    public function merci()
    {
        return $this->render('contact/merci.html.twig');
    }
    
    /**
     * 
     * @Route("/contact/mentions-legales.html", name="contact_mentions_legales")
     */
    public function mentionsLegales()
    {
        return $this->render('contact/mentions_legales.html.twig');
    }
}
