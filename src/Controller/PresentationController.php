<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationController extends AbstractController
{
    #[Route('/presentation', name: 'app_presentation')]
    public function index(): Response
    {
        $user = $this->getUser();

        if ($user instanceof User) {
            $areInformationsFilled = $user->getPc() || $user->getAddress() || $user->getCity() || $user->getPhone();
            if (!$areInformationsFilled) {
                $this->addFlash('warning', 'Vos informations semblent incomplètes, complétez les en accédant à votre profil.');
            }
        }

        return $this->render('presentation/index.html.twig', [
            'controller_name' => 'PresentationController',
        ]);
    }
}
