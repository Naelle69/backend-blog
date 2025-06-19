<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            TextField::new('title'),
            TextField::new('subtitle'),
            TextEditorField::new('content'),
            TextField::new('slug')->hideOnIndex(),

            IntegerField::new('readingTime'),
            BooleanField::new('isPublished'),

            AssociationField::new('category'),
            AssociationField::new('tags'),

            Field::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),

            ImageField::new('imageName')
                ->setBasePath('/uploads/articles')
                ->onlyOnIndex(),

            DateTimeField::new('updatedAt')->setFormTypeOption('widget', 'single_text'),
        ];
    }
}
