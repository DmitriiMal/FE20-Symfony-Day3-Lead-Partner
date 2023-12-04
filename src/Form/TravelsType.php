<?php

namespace App\Form;

use App\Entity\Travels;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country')
            ->add('town')
            ->add('hotel')
            ->add('days')
            ->add('price')
            ->add('all_included')
            ->add('created_at')
            ->add('picture')
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Travels::class,
        ]);
    }
}
