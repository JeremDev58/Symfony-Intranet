<?php

namespace App\Form;

use App\Entity\Domaine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DomaineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array(
                'label' => 'Titre',
                'required' => true,
            ))
            ->add('php', ChoiceType::class, [
                 'choices'  => [
                      "5.6" => 5.6,
                      "7.0" => 7.0,
                      "7.2" => 7.2
                 ],
            ])
            ->add('domaineLocale', TextType::class, array(
                'label' => 'Domaine Locale',
                'required' => true,
            ))
            ->add('vhost', CheckboxType::class, [
                 'label' => 'Vhost',
                 'required' => false,
            ]
            )
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Domaine::class,
        ]);
    }
}
