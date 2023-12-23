<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FAQController extends AbstractController
{
    #[Route('/faq', name: 'app_faq')]
    public function index(QuestionRepository $questionRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // récupération de toutes les questions avec le nombre de réponses pour chacune d'entre elles
        $questions = $questionRepository->countAnswersForAllQuestionsAndOrderByDateDesc();

        // récupération de toutes les questions posées par l'utilisateur courant
        $questionsByUser = $questionRepository->findBy(['author' => $user], ['createdAt' => 'DESC']);

        return $this->render('faq/index.html.twig', [
            'user' => $user,
            'questions' => $questions,
            'ownQuestions' => $questionsByUser,
        ]);
    }

    #[Route('/faq/{id}', name: 'app_faq_show')]
    public function show(QuestionRepository $questionRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('faq/show.html.twig', [
            'user' => $user,
        ]);
    }

}
