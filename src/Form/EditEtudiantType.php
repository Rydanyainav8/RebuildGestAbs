<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditEtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('lastname')
            ->add('firstname')
            ->add('pdp', FileType::class,[
                'mapped' => false,
                'required' => true,
            ])
            ->add('grade', ChoiceType::class, [
                'choices' => [
                    'Licence 1' => 'L1',
                    'Licence 2' => 'L2',
                    'Licence 3' => 'L3',
                    'Master 1' => 'M1',
                    'Master 2' => 'M2'
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
