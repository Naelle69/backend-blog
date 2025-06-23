<?php

namespace App\Command;

use App\Entity\RecipeCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;


#[AsCommand(name: 'app:import-recipe-categories')]
class ImportRecipeCategoriesCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $categories = [
            ['name' => 'Entrée', 'slug' => 'entree', 'description' => 'Recettes pour commencer un repas'],
            ['name' => 'Plat principal', 'slug' => 'plat-principal', 'description' => 'Recettes consistantes pour le repas principal'],
            ['name' => 'Dessert', 'slug' => 'dessert', 'description' => 'Recettes sucrées pour terminer le repas'],
            ['name' => 'Végétarien', 'slug' => 'vegetarien', 'description' => 'Recettes sans viande ni poisson'],
            ['name' => 'Vegan', 'slug' => 'vegan', 'description' => "Recettes sans produits d'origine animale"],
            ['name' => 'Petit déjeuner', 'slug' => 'petit-dejeuner', 'description' => 'Recettes pour bien commencer la journée'],
            ['name' => 'Goûter', 'slug' => 'gouter', 'description' => "Recettes pour les petites faims de l’après-midi"],
            ['name' => 'Apéritif', 'slug' => 'aperitif', 'description' => 'Recettes pour accompagner un apéro'],
            ['name' => 'Soupes & Veloutés', 'slug' => 'soupes-veloutes', 'description' => 'Recettes de soupes chaudes ou froides'],
            ['name' => 'Salades', 'slug' => 'salades', 'description' => 'Recettes fraîches et légères'],
            ['name' => 'Recettes afros', 'slug' => 'recettes-afros', 'description' => 'Recettes traditionnelles et modernes de la cuisine africaine'],
            ['name' => 'Pâtisseries', 'slug' => 'patisseries', 'description' => 'Recettes de gâteaux, tartes, viennoiseries et douceurs sucrées'],
            ['name' => 'Snacks', 'slug' => 'snacks', 'description' => 'Recettes rapides et simples à déguster à tout moment'],
            ['name' => 'Boissons', 'slug' => 'boissons', 'description' => 'Recettes de boissons fraîches, chaudes ou énergisantes'],
        ];

        foreach ($categories as $data) {
            $category = new RecipeCategory();
            $category->setName($data['name']);
            $category->setSlug($data['slug']);
            $category->setDescription($data['description']);
            $this->em->persist($category);
        }

        $this->em->flush();
        $output->writeln('✅ Catégories de recettes importées avec succès.');

        return Command::SUCCESS;
    }
}
