<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
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
            ->add('grade', ChoiceType::class, [
                'choices' => [
                    'Licence I' => 'L1',
                    'Licence II' => [
                        'Licence II IDEV' => 'L2 IDEV',
                        'Licence II RSI' => 'L2 RSI',
                    ],
                    'Licence III' => [
                        'Licence III IDEV' => 'L3 IDEV',
                        'Licence III RSI' => 'L3 RSI',
                    ],
                    'Master I' => 'M1',
                    'Master II' => 'M2'
                ],
                'label' => 'Niveau',
                'expanded' => true,
                'multiple' => false,
                'label_attr'  => array('class' => 'checkbox-inline') 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
