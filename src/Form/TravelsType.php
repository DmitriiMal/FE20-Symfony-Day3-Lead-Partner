<?php

namespace App\Form;

use App\Entity\Travels;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country', TextType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'mardin-bottom:15px']
            ])
            ->add('town', TextType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'mardin-bottom:15px']
            ])
            ->add('hotel', TextType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'mardin-bottom:15px']
            ])
            ->add('days', NumberType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'mardin-bottom:15px']
            ])
            ->add('price', NumberType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px', 'step' => '0.1']
            ])
            ->add('all_included', ChoiceType::class, [
                'choices' => ['yes' => 1, 'no' => 0],
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
            ])
            // ->add('created_at')
            ->add('picture', TextType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Travels::class,
        ]);
    }
}
