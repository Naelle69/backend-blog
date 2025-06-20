<?php

namespace App\Controller\Admin;

use App\Entity\RecipeIngredient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class RecipeIngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RecipeIngredient::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),

            AssociationField::new('recipe', 'Recette'),
            AssociationField::new('ingredient', 'Ingrédient'),

            NumberField::new('quantity', 'Quantité'),
            TextField::new('unitOverride', 'Unité spécifique')->setHelp('Ex. : cuillère, ml, etc.')->setRequired(false),
            TextareaField::new('note', 'Note')->hideOnIndex()->setRequired(false),
        ];
    }
}
