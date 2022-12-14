<?php

namespace App\Form;

use App\Entity\Figure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom de la figure'
                )
            ))
            ->add('description', null, array('label' => false))
            ->add('category', null, [
                'label' => false,
                'placeholder' => 'Catégorie'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Figure::class,
        ]);
    }
}