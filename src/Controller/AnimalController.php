<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal')]
    public function index(animalRepository $animalRepository): Response
    {
        $animals = $animalRepository->findBy([], ['name' => 'ASC']);
        return $this->render('animal/index.html.twig', [
            'animals' => $animals,
        ]);
    }
}
