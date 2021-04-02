<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-group form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le prénom est obligatoire'
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille',
                'attr' => [
                    'class' => 'form-group form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom est obligatoire'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Adresse e-mail",
                'attr' => [
                    'class' => 'form-group form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "L'adresse e-mail est obligatoire"
                    ])
                ]
            ])
            ->add('telNumber', TextType::class, [
                'label' => 'Numéro(s) de téléphone de contact',
                'attr' => [
                    'class' => 'form-group form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Un numéro de contact est obligatoire'
                    ])
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'form-group form-control'
                ]
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'class' => 'form-group form-control'
                ],
                'constraints' => [
                    new length ([
                        'min' => 5,
                        'max' => 5,
                        'exactMessage' => 'Le code postal doit comporter 5 chiffres'
                    ])
                ]
            ])
            ->add('birthDate', BirthdayType::class, [
                'label' => 'Date de naissance',
                'attr' => [
                    'class' => 'form-group form-control'
                ],
                'widget' => 'single_text'
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
