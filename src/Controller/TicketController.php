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
        $ticketbuy= $ticket->findBy([], ['id' => 'ASC']);
        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
            'ticket' => $ticketbuy
        ]);
    }

    #[Route('/ticket/{id}', name: 'app_ticket_id')]
    public function show(Ticket $ticket): Response
    {
        return $this->render('ticket/show.html.twig', [
            '' => $]);
    }
}
