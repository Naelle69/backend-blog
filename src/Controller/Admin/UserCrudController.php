<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            EmailField::new('email'),
            TextField::new('name'),
            ArrayField::new('roles'),
            TextEditorField::new('bio'),
            TextField::new('profilePicture')->hideOnIndex(),
            DateTimeField::new('createdAt')->setFormTypeOption('widget', 'single_text'),
            ImageField::new('profilePicture')
                        ->setBasePath('/uploads/users')
                        ->setUploadDir('public/uploads/users')
                        ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                        ->setRequired(false),
        ];
    }
}
