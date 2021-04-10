<?php

namespace App\Form;

use App\Entity\Rdv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Date du rdv',
                'attr' => [
                    'class' => 'form-group form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'la date doit être définie'
                    ])
                ],
                'widget' => 'single_text',
                'mapped' => false,
            ])
            ->add('heureDebut', TimeType::class, [
                'label' => 'Heure de début',
                'attr' => [
                    'class' => 'form-group form-control',
                ],
                'input'  => 'datetime',
                'widget' => 'choice',
                'hours' => [
                    '08','09','10','11','12','13','14','15','16','17','18','19'
                ],
                'mapped' => false,
            ])
            ->add('heureFin', TimeType::class, [
                'label' => 'Heure de fin',
                'attr' => [
                    'class' => 'form-group form-control'
                ],
                'input'  => 'datetime',
                'widget' => 'choice',
                'hours' => [
                    '08','09','10','11','12','13','14','15','16','17','18','19'
                ],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}
