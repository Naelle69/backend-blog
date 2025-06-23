<?php

namespace App\Command;

use App\Entity\Ingredient;
use App\Service\OpenFoodFactsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:import-ingredients')]
class ImportIngredientsCommand extends Command
{
    public function __construct(
        private OpenFoodFactsService $offService,
        private EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $keywords = ['tomato', 'milk', 'sugar', 'lemon']; // 🔁 Tu peux élargir cette liste

        foreach ($keywords as $keyword) {
            $product = $this->offService->fetchProductByName($keyword);

            if (!$product || empty($product['product_name'])) {
                $output->writeln("⛔ Aucun produit trouvé pour: $keyword");
                continue;
            }

            $ingredient = new Ingredient();
            $ingredient->setName($product['product_name']);
            $ingredient->setOrigin($product['origins'] ?? 'Inconnue');
            $ingredient->setPrice(0);
            $ingredient->setUnit('kg');
            $labels = implode(',', $product['labels_tags'] ?? []);
            $isOrganic = str_contains($labels, 'organic');
            $ingredient->setIsOrganic($isOrganic);
            $ingredient->setEcoImpact($product['ecoscore_grade'] ?? 'unknown');
            $ingredient->setSource('openfoodfacts.org');
            $ingredient->setExternalId($product['code'] ?? null);

            $existing = $this->em->getRepository(Ingredient::class)->findOneBy(['name' => $product['product_name']]);
                if ($existing) {
                    continue;
            }

            $this->em->persist($ingredient);

        }

        $this->em->flush();
        $output->writeln("✅ Ingrédients importés avec succès.");

        return Command::SUCCESS;
    }
}
