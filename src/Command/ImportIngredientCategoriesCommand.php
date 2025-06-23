<?php

namespace App\Command;


use App\Entity\IngredientsCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;


#[AsCommand(
    name: 'app:import-ingredient-categories',
    description: 'Importe les catégories d\'ingrédients dans la base de données.'
)]
class ImportIngredientCategoriesCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $names = [
            'Légumes',
            'Fruits',
            'Viandes',
            'Produits laitiers',
            'Céréales',
            'Épices',
            'Produits sucrés',
            'Huiles',
            'Poissons',
            'Plantes aromatiques'
        ];

        foreach ($names as $name) {
            $category = new IngredientsCategory();
            $category->setName($name);
            $this->em->persist($category);
            $output->writeln("✅ Catégorie créée : $name");
        }

        $this->em->flush();
        $output->writeln("🎉 Toutes les catégories ont été ajoutées.");

        return Command::SUCCESS;
    }
}
