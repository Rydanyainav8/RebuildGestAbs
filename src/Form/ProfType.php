<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Prof;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('lastname')
            ->add('firstname')
            ->add('pdp', FileType::class,[
                'mapped' => false,
                'required' => true,
            ])
            ->add('modules', EntityType::class,[
                'class' => Module::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => true,
                'label_attr' => array('class' => 'radio-inline'),
                'mapped' => false,
                'required' => false,
                'placeholder' => 'Plus tard...'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prof::class,
        ]);
    }
}
