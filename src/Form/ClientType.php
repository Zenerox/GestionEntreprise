<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-group form-control'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille',
                'attr' => [
                    'class' => 'form-group form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Adresse e-mail",
                'attr' => [
                    'class' => 'form-group form-control'
                ]
            ])
            ->add('tel_number', TextType::class, [
                'label' => 'Numéro(s) de téléphone de contact',
                'attr' => [
                    'class' => 'form-group form-control'
                ]
            ])
            ->add('birth_date', BirthdayType::class, [
                'label' => 'Date de naissance',
                'attr' => [
                    'class' => 'form-group form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
