<?php

namespace App\Form;


// use App\Entity\Status as EntityStatus;
use App\Entity\Travels;
use App\Entity\Status;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;


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
            ])
            ->add('fk_status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control mb-3']
            ])
            ->add('picture', FileType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Upload Picture',
                //unmapped means that is not associated to any entity property
                'mapped' => false,
                // mandatory to have a file
                'required' => true,

                //in the associated entity, so you can use the PHP constraint classes as validators
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Travels::class,
        ]);
    }
}
