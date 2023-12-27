<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
    public function show(QuestionRepository $questionRepository, Question $questionId, Request $request, EntityManagerInterface $entityManager): Response
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

        // formulaire de réponse à une question

        /* $formAnswer = $this->createFormBuilder(options: ['attr' => ['class' => 'reply-form']])
            ->add('description')
            ->add('submit', SubmitType::class, ['label' => 'Répondre', 'attr' => ['class' => 'btn button-primary']])
            ->getForm(); */

        $answer = new Answer();

        $formAnswer = $this->createForm(AnswerType::class, $answer, ['attr' => ['class' => 'reply-form']])
            ->add('submit', SubmitType::class, ['label' => 'Répondre', 'attr' => ['class' => 'btn button-primary full-width']]);

        $formAnswer->handleRequest($request);

        if ($formAnswer->isSubmitted() && $formAnswer->isValid()) {
            //$answer->setAuthor($user);
            $answer->setAuthor($this->getUser());
            $answer->setQuestion($question);
            $answer->setCreatedAt(new \DateTimeImmutable('now'));

            $entityManager->persist($answer);
            $entityManager->flush();

            $this->addFlash('success', 'Votre réponse a bien été ajoutée!');
            return $this->redirectToRoute('app_faq_show', ['id' => $question->getId()]);
        }


        return $this->render('faq/show.html.twig', [
            'user' => $user,
            'question' => $question,
            'answers' => $answers,
            'answersLength' => $answersLength,
            'formAnswer' => $formAnswer,
        ]);
    }

}
