<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CreationClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre', TextType::class, array(
            'label' => 'Nom de la société'
        ))
        ->add('categorie', null, array(
            'label' => 'Secteur d\'activité'
        ))
        ->add('siret', TextType::class, array(
            'label' => 'N° SIRET'
        ))
        ->add('adresse', TextType::class)
        ->add('contacts', CollectionType::class, array(
            'entry_type' => ContactType::class,
            'allow_add' => true,
            'entry_options' => array( 'label' => false ),
            'by_reference' => false,
            'label' => '',
        ))
        ->add('projets', CollectionType::class, array(
            'entry_type' => ProjetType::class,
            'allow_add' => true,
            'entry_options' => array( 'label' => false ),
            'by_reference' => false,
            'label' => '',
        ))
        ->add('domaines', CollectionType::class, array(
            'entry_type' => DomaineType::class,
            'allow_add' => true,
            'entry_options' => array( 'label' => false ),
            'by_reference' => false,
            'label' => '',
        ))
        ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
