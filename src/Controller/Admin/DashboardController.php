<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category; // Catégories d'articles
use App\Entity\Comment;
use App\Entity\ContactMessage;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/custom_dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('🌿 Green & Glow');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('📊 Tableau de bord');

        // Blog
        yield MenuItem::section('📝 Gestion des articles');
        yield MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('Catégories d’articles', 'fas fa-folder', Category::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comments', Comment::class);

        // Recettes
        yield MenuItem::section('🌿 Recettes naturelles');
        yield MenuItem::linkToCrud('Recettes', 'fas fa-utensils', Recipe::class);
        yield MenuItem::linkToCrud('Catégories de recettes', 'fas fa-seedling', RecipeCategory::class);

        // Communauté
        yield MenuItem::section('👥 Communauté & Messages');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Messages de contact', 'fas fa-envelope', ContactMessage::class);

        // Site public
        yield MenuItem::section('🌐 Site public');
        yield MenuItem::linkToUrl('Voir le site', 'fas fa-globe', '/');
    }
}

