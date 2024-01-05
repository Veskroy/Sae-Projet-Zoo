<?php

namespace App\Controller;

use App\Repository\FamilyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamilyController extends AbstractController
{
    #[Route('/family', name: 'app_family')]
    public function index(familyRepository $familyRepository): Response
    {
        $families = $familyRepository->findBy([], ['name' => 'ASC']);
        return $this->render('family/index.html.twig', [
            'families' => $families,
        ]);
    }
}
