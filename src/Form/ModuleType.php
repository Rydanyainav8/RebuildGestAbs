<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Prof;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('category', ChoiceType::class,[
                'choices' => [
                    'Commun' => 'COMM',
                    'Réseau & Système d\'intégration' => 'RSI',
                    'Developpement & Programation' => 'DEV'
                ],
                'expanded' => true,
                'multiple' => false,
                'label_attr' => array('class' => 'radio-inline')
            ])
            ->add('prof', EntityType::class,[
                'class' => Prof::class,
                'choice_label' => 'email',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
