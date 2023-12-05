<?php

namespace App\Controller;

use App\Form\DeleteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profile/delete', name: 'app_profile_delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $formDelete = $this->createForm(DeleteType::class, null, [
            'attr' => ['class' => 'delete-form'],
        ]);

        $formDelete->handleRequest($request);

        if ($formDelete->isSubmitted()) {
            if ($formDelete->get('delete')->isClicked()) {
                // déconnexion de l'utilisateur courant
                $request->getSession()->invalidate();
                $this->container->get('security.token_storage')->setToken(null);
                // suppression de l'utilisateur
                $entityManager->remove($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_login', ['deleteProfileMessage' => true]);
            } else {
                return $this->redirectToRoute('app_profile', ['user' => $user]);
            }
        } else {
            return $this->render('profile/delete.html.twig', ['user' => $user, 'formDelete' => $formDelete]);
        }

    }

}
