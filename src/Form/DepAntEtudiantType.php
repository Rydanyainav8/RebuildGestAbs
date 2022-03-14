<?php

namespace App\Form;

use App\Entity\DepAntEtudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepAntEtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('motif', TextareaType::class)
        ->add('email1', EmailType::class,[
            'mapped' => false,
            'required' => true,
        ])
        ->add('tempDep', DateTimeType::class,[
            'widget' => 'single_text',
        ])
        ->add('tempArr', DateTimeType::class,[
            'widget' => 'single_text',
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DepAntEtudiant::class,
        ]);
    }
}
