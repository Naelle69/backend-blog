<?php

// src/Controller/Admin/RecipeCrudController.php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('title'),

            TextareaField::new('ingredients')
                ->hideOnIndex(),

            TextareaField::new('steps')
                ->hideOnIndex(),

            ImageField::new('image')
                ->setBasePath('/uploads/recipes')
                ->setUploadDir('public/uploads/recipes')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired(false),

            DateTimeField::new('createdAt')->setFormTypeOptions([
                'widget' => 'single_text',
            ]),

            BooleanField::new('isPublished'),

            AssociationField::new('category'),
        ];
    }
}

