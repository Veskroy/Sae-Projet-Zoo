<?php

namespace App\Controller;

use App\Form\DeleteType;
use App\Form\ProfilePasswordType;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // formulaire pour les informations principales

        $formChangeInformations = $this->createForm(ProfileType::class, $user, [
            'attr' => ['class' => 'change-form']
        ])->add('edit', SubmitType::class, ['label' => 'Modifier mes informations', 'attr' => ['class' => 'btn button-primary full-width']]);

        $formChangeInformations->handleRequest($request);
        // validation du formulaire
        if ($formChangeInformations->isSubmitted() && $formChangeInformations->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre compte a bien été modifié!');
        }

        // formulaire pour un nouveau mot de passe

        $formChangePassword = $this->createForm(ProfilePasswordType::class, null, [
            'attr' => ['class' => 'password-form']
        ])->add('update', SubmitType::class, ['label' => 'Modifier mon mot de passe', 'attr' => ['class' => 'btn button-primary full-width']]);

        $formChangePassword->handleRequest($request);

        if ($formChangePassword->isSubmitted()) {
            $currentPassword = $formChangePassword->get('currentPassword')->getData();
            $comparePasswords = $userPasswordHasher->isPasswordValid($user,  $currentPassword);
            if (!$currentPassword || !$comparePasswords) {
                $this->addFlash('error', 'Le mot de passe saisi ne correspond pas à votre mot de passe.');
            } else {
                $newPassword = $formChangePassword->get('newPassword')->getData();
                if ($newPassword) {
                    $user->setPassword($userPasswordHasher->hashPassword($user, $newPassword));
                    $entityManager->flush();
                    $this->addFlash('success', 'Le mot de passe a bien été modifié!');
                } else {
                    $this->addFlash('error', 'Vous avez saisi deux mots de passe différents...');
                }
            }
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'formChangeInformations' => $formChangeInformations,
            'formChangePassword' => $formChangePassword
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

                $this->addFlash('success', 'Votre compte a bien été supprimé!');

                return $this->redirectToRoute('app_login');
            } else {
                return $this->redirectToRoute('app_profile', ['user' => $user]);
            }
        } else {
            return $this->render('profile/delete.html.twig', ['user' => $user, 'formDelete' => $formDelete]);
        }

    }

}
