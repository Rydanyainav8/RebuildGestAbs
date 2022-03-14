<?php

namespace App\Form;

use App\Entity\AbsEtudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsenceEtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('motif', TextareaType::class)
            ->add('imgJustif', FileType::class, [
                'mapped' => false,
                'required' => false, 
            ])
            ->add('email1', EmailType::class,[
                'mapped' => false,
                'required' => true,
            ])
            // ->add('email2', EmailType::class,[
            //     'mapped' => false,
            //     'required' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AbsEtudiant::class,
        ]);
    }
}
