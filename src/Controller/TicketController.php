<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/ticket', name: 'app_ticket')]
    public function index(TicketRepository $ticket): Response
    {
        $tickets= $ticket->findBy([], ['id' => 'ASC']);
        $newticket= new Ticket();
        $form = $this->createForm(TicketType::class, $newticket);

        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
            'tickets' => $tickets,
            'form'=>$form

        ]);
    }

    #[Route('/ticket/{id}', name: 'app_ticket_id')]
    public function show(Ticket $ticket): Response
    {
        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket]);
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
