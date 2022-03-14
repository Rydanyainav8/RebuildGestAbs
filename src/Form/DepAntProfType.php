<?php

namespace App\Form;

use App\Entity\DepAntProf;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepAntProfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('motif')
            ->add('email1', EmailType::class,[
                'mapped' => false,
                'required' => true
            ])
            ->add('tempDep', DateTimeType::class,[
                'widget' => 'single_text',
            ])
            ->add('tempArr',DateTimeType::class,[
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DepAntProf::class,
        ]);
    }
}
