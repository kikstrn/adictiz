<?php

namespace App\Form;

use App\Entity\Files;
use Symfony\Component\Form\AbstractType;
use App\Validator\Constraints\EasyAdminFile;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FilesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('imageFile', FileType::class, [
            'label' => 'Insérez une image',
            'required' => true,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Files::class,
        ]);
    }
}
