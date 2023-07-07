<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Domaine;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use App\Repository\DomaineRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProjetType extends AbstractType
{
    private $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $projet = $builder->getData();
        
        $builder
            ->add('titre', TextType::class, array(
                'label' => 'Nom du projet'
            ))
            ->add('chemin_local')
            ->add('url_admin')
            ->add('identifiant_admin')
            ->add('mdp_admin')
            ->add('nom_bdd')
            ->add('domaine', EntityType::class, array(
                'required' => false,
                'label' => 'Domaine principal',
                'class' => Domaine::class,
                'query_builder' => function(EntityRepository $er) use ($projet){
                    if($projet){
                        return $er->createQueryBuilder('d')
                                ->andWhere('d.client = :client')
                                ->setParameters(['client' => $projet->getClient()]);
                    }
                },
                
            ))
            ->add('nouveau_domaine', TextType::class, array(
                'label' => 'Nouveau domaine',
                'mapped' => false,
                'required' => false,
            ))
            ->add('hebergement', null, array(
                'label' => 'Hébergement'
            ))
            ->add('enregistrer', SubmitType::class)
            ->addEventListener(FormEvents::POST_SUBMIT, array($this, 'onPostSubmit'))
        ;
    }
    
    public function onPostSubmit(FormEvent $event)
    {
        $projet = $event->getData();
        
        $form = $event->getForm();
        
        if(strlen($form['nouveau_domaine']->getData())>0){
            $domaine = new Domaine();
            
            $domaine->setTitre($form['nouveau_domaine']->getData());
            $domaine->setClient($projet->getClient());
            
            $this->em->persist($domaine);
            $this->em->flush();
            
            $projet->setDomaine($domaine);
        }        
        
        
        if(strlen($projet->getCheminLocal())> 0){
            $array_domaine = explode('.',$projet->getDomaine()->getTitre());
            
            $domaine_local = '';
            for($i = 0; $i < count($array_domaine) - 1; $i++){
                $domaine_local .= $array_domaine[$i].'.';
            }
            $domaine_local .= 'dw';
            
            $projet->setDomaineLocal($domaine_local);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
