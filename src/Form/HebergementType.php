<?php

namespace App\Form;

use App\Entity\Hebergement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HebergementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('nic_admin', TextType::class, array(
                'label' => 'Admin',
                'required' => true,
                'attr' => [                    
                    'placeholder' => 'Identifiant',
                ],
            ))
            ->add('nic_admin_pwd', TextType::class, array(
                'label' => '',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Mot de passe',
                ],
            ))
            ->add('nic_tech', TextType::class, array(
                'label' => 'Technique',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Identifiant',
                ],
            ))
            ->add('nic_tech_pwd', TextType::class, array(
                'label' => '',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Mot de passe',
                ],
            ))
            ->add('nic_prop', TextType::class, array(
                'label' => 'Propriétaire',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Identifiant',
                ],
            ))
            ->add('nic_prop_pwd', TextType::class, array(
                'label' => '',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Mot de passe',
                ],
            ))
            ->add('ftp_adresse', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('ftp_id', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('ftp_pass', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('mysql_adresse', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('mysql_serveur', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('mysql_id', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('mysql_pass', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('propriete_client', null, array(
                'label' => 'Le client est propriétaire de l\'hébergement'
            ))
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hebergement::class,
        ]);
    }
}
