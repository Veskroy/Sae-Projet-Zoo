<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Utilisateurs');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un utilisateur', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des utilisateurs', 'fas fa-eye', User::class),
        ]);

        yield MenuItem::section('Posts');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter une question', 'fas fa-plus', Question::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des questions', 'fas fa-eye', Question::class),
        ]);

        yield MenuItem::section('Réponses');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            //MenuItem::linkToCrud('Ajouter une réponse', 'fas fa-plus', Question::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des réponses', 'fas fa-eye', Answer::class),
        ]);

    }
}
