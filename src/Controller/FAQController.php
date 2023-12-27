<?php

namespace App\Controller;

use App\Entity\Question;
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
        $ownQuestions = $questionRepository->findBy(['author' => $user], ['createdAt' => 'DESC']);

        return $this->render('faq/index.html.twig', [
            'user' => $user,
            'questions' => $questions,
            'ownQuestions' => $ownQuestions,
        ]);
    }

    #[Route('/faq/{id}', name: 'app_faq_show')]
    public function show(QuestionRepository $questionRepository, Question $questionId): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $question = $questionRepository->findOneBy(['id' => $questionId]);
        $answers = $question->getAnswers()->toArray();
        usort($answers, function ($a, $b) {
            return $a->getCreatedAt() <=> $b->getCreatedAt();
        });
        $answersLength = count($answers);

        return $this->render('faq/show.html.twig', [
            'user' => $user,
            'question' => $question,
            'answers' => $answers,
            'answersLength' => $answersLength,
        ]);
    }

}
