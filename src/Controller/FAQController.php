<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        // pagination
        $pagination = $paginator->paginate(
            $questionRepository->getAllQuestionsOrderByDateDesc(),
            $request->query->getInt('page', 1),
            10
        );

        //dd($pagination);

        return $this->render('faq/index.html.twig', [
            'user' => $user,
            'pagination' => $pagination,
        ]);
    }

}
