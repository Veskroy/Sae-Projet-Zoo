<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FAQController extends AbstractController
{
    #[Route('/forum', name: 'app_forum')]
    public function index(QuestionRepository $questionRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // récupération de toutes les questions avec le nombre de réponses pour chacune d'entre elles
        //$questions = $questionRepository->countAnswersForAllQuestionsAndOrderByDateDesc();

        // pagination
        $pagination = $paginator->paginate(
            $questionRepository->getAllQuestionsOrderByDateDesc(),
            $request->query->getInt('page', 1),
            10
        );

        //dd($pagination);

        return $this->render('faq/index.html.twig', [
            'user' => $user,
            //'questions' => $questions,
            'pagination' => $pagination,
        ]);
    }

}
