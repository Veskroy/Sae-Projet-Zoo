<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerType;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{

    /**
     * @throws Exception
     */
    #[Route('/question/{id}', name: 'app_question_show', requirements: ['id' => '\d+'])]
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
            $answer->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris')));

            $entityManager->persist($answer);
            $entityManager->flush();

            $this->addFlash('success', 'Votre réponse a bien été ajoutée!');
            return $this->redirectToRoute('app_question_show', ['id' => $question->getId()]);
        }

        // formulaire pour "réouvrir" son post ou le fermer

        $formSetResolved = $this->createFormBuilder(options: ['attr' => ['class' => 'setResolved']])
            ->add('submit', SubmitType::class)
            ->getForm();

        $formSetResolved->handleRequest($request);

        if ($formSetResolved->isSubmitted() && $formSetResolved->isValid()) {
            // utiliser isAdmin plutôt que in_array(...)
            if ($user === $question->getAuthor() || in_array('ROLE_ADMIN', $user->getRoles())) {
                $question->setIsResolved(!$question->isIsResolved());

                $entityManager->persist($question);
                $entityManager->flush();

                $this->addFlash('success', $question->isIsResolved() ? 'Ce post a bien été clôturé!' : 'Ce post a bien été réouvert!');
                return $this->redirectToRoute('app_question_show', ['id' => $question->getId()]);
            } else {
                $this->addFlash('error', 'Vous n\'avez pas les droits requis.');
            }
        }

        return $this->render('question/show.html.twig', [
            'user' => $user,
            'question' => $question,
            'answers' => $answers,
            'answersLength' => $answersLength,
            'formAnswer' => $formAnswer,
            'formSetResolved' => $formSetResolved
        ]);
    }

    #[Route('/questions/me', name: 'app_user_questions')]
    public function userQuestions(QuestionRepository $questionRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // récupération de toutes les questions posées par l'utilisateur courant
        $ownQuestions = $questionRepository->findBy(['author' => $user], ['createdAt' => 'DESC']);

        return $this->render('question/data.html.twig', [
            'user' => $user,
            'ownQuestions' => $ownQuestions,
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/question/new', name: 'app_question_new')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $question = new Question();

        $formQuestion = $this->createForm(QuestionType::class, $question, ['attr' => ['class' => 'question-form']])
            ->add('submit', SubmitType::class, ['label' => 'Créer le post', 'attr' => ['class' => 'btn button-primary full-width']]);

        $formQuestion->handleRequest($request);

        if ($formQuestion->isSubmitted() && $formQuestion->isValid()) {
            //$answer->setAuthor($user);
            $question->setAuthor($this->getUser());
            $question->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris')));
            $question->setIsResolved(false);

            $entityManager->persist($question);
            $entityManager->flush();

            $this->addFlash('success', 'Votre post a bien été créé!');
            return $this->redirectToRoute('app_user_questions');
        }
        return $this->render('question/new.html.twig', [
            'user' => $user,
            'formQuestion' => $formQuestion,
        ]);
    }

}
