<?php

namespace App\Controller\Admin;

use App\Entity\Files;
use App\Validator\Constraints\EasyAdminFile;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FilesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Files::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('imageFile', 'Upload')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            ImageField::new('fileName', 'Files')
                ->setBasePath('http://127.0.0.1:9000/adictiz/')
                ->hideOnForm()
                ->setFormTypeOption(
                    'constraints',
                    [
                        new EasyAdminFile([
                            'mimeTypes' => [ // We want to let upload only jpeg or png
                                'image/jpeg',
                                'image/png',
                            ],
                        ])
                    ]
                )
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(10)
        ;
    }
}
