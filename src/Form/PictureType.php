<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Form\CallbackTransformer;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('files', FileType::class, [
            'label' => 'Insérez une ou plusieurs images',
            'data_class'=> null,
            'empty_data' => '',
            'mapped' => false,
            'multiple' => true,
            'required' => true,
            'constraints' => [
                new All([ 'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                    ])
                ]
                ])
            ],
            'attr' => [
                'accept' => '.jpg, .jpeg, .png'
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
