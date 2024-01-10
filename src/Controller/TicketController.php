<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use GuzzleHttp\Psr7\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/ticket', name: 'app_ticket')]
    public function index(TicketRepository $ticket): Response
    {
        $tickets= $ticket->findBy([], ['id' => 'ASC']);

        $newticket= new Ticket();
        $form = $this->createForm(TicketType::class, $newticket)
                        ->add('submit', SubmitType::class,['label'=> 'Obtenir un nouveaux ticket']);

       /* $form->handleRequest($resquest);*/

       /* if ($form->isSubmitted() && $form->isValid()) {

        }*/

        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
            'tickets' => $tickets,
            'form'=>$form

        ]);
    }

    #[Route('/ticket/{id}', name: 'app_ticket_id')]
    public function show(Ticket $ticket): Response
    {
        $user=$this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket,
            'user'=>$user]);
    }

    #[Route ('/ticket/Create', name: 'app_ticket_create')]
    public function create() :Response
    {   $newticket= new Ticket();
        $form = $this->createForm(TicketType::class, $newticket);
        return $this->render('ticket/ticketcreate.html.twig', [
            'form'=>$form
       ]); }

    #[Route ('/ticket/{id}/delete', name: 'app_ticket_delete',requirements: ['id' => '\d+'])]
    public function delete(Ticket $ticket) :Response
    {return $this->render('ticket/', [
    ]); }
    #[Route ('/ticket/{id}/Update', name: 'app_ticket_update',  requirements: ['id' => '\d+'])]
    public function update(Ticket $ticket) :Response
    {return $this->render('ticket/', [
    ]); }
}
