<?php

namespace App\Controller;

use App\Entity\Ticket;
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

        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
            'tickets' => $tickets
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
    {return $this->render('ticket/', [
       ]); }
    #[Route ('/ticket/{id}/delete', name: 'app_ticket_delete')]
    public function delete(Ticket $ticket) :Response
    {return $this->render('ticket/', [
    ]); }
    #[Route ('/ticket/{id}/Update', name: 'app_ticket_update')]
    public function update() :Response
    {return $this->render('ticket/', [
    ]); }
}
