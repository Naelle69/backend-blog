<?php

namespace App\Controller\Admin;

use APP\Entity\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class IngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingredient::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Nom'),
            TextField::new('origin', 'Origine'),
            NumberField::new('price', 'Prix'),
            ChoiceField::new('unit', 'Unité')
                ->setChoices([
                    'kg' => 'kg',
                    'g' => 'g',
                    'L' => 'L',
                    'ml' => 'ml',
                    'cuillère à soupe' => 'cuillère à soupe',
                    'cuillère à café' => 'cuillère à café',
                    'tasse' => 'tasse',
                    'verre' => 'verre',
                    'pincée' => 'pincée',
                    'pièce' => 'pièce',
                    'quantité au choix' => 'quantité au choix',
                ]),
            BooleanField::new('isOrganic', 'Bio'),
            TextField::new('ecoImpact', 'Impact Écologique'),
            TextField::new('source', 'Source'),
        ];
    }
}