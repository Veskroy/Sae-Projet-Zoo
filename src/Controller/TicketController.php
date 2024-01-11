<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    /// methode de conversion du type en price for entity ticket
    private function forsetprice($type){
        switch ($type) {
            case 'ENFANT':
                $price = 12;
                break;
            case 'ETUDIANT':
                $price = 15;
                break;
            case 'SENIOR':
                $price = 16;
                break;
            case 'JUNIOR':
                $price = 0;
                break;
            case 'HANDICAPE':
                $price = 14;
                break;
            case 'CLASSIC':
                $price = 20;
                break;
            default:
                $price = null;
        } return $price;
    }
    #[Route('/ticket', name: 'app_ticket')]
    public function index(TicketRepository $ticketRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $tickets = $ticketRepository->findBy(['user' => $user]);

        $pastTickets = [];
        /*foreach ($tickets as $ticket) {
            if ($ticket->getDate() < new \DateTime()) {
                $pastTickets[] = $ticket;
            }
        }
        $avalaibleTickets = array_diff($tickets, $pastTickets); */

        $pastTickets = array_filter($tickets, function ($ticket) {
            return $ticket->getDate() < new \DateTime('-1 day');
        });

        $availableTickets = array_filter($tickets, function ($ticket) {
            return $ticket->getDate() >= new \DateTime('-1 day');
        });

        usort($availableTickets, function ($ticket1, $ticket2) {
            return $ticket1->getDate() <=> $ticket2->getDate();
        });
            /////// Formulaire

        $newticket= new Ticket();
        $form = $this->createForm(TicketType::class, $newticket)
            ->add('submit', SubmitType::class, ['label' => 'Obtenir mon nouveau ticket', 'attr' => ['class' => 'btn button-primary full-width mt-50']]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newticket->setUser($this->getUser());
            $newticket->setPrice( $this->forsetprice($newticket->getType()));

            /// comparaison date


         if ($newticket->getDate() < new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'))) {
             $this->addFlash('error',"La date donnée n'est pas valable");
         }
         else {
             $entityManager->persist($newticket);
             $entityManager->flush();
             $this->addFlash('success', "Votre ticket a été enregistre !{}" . $newticket->getDate());
         }
         }

        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
            'tickets' => $tickets,
            'form'=>$form,
            'pastTickets' => $pastTickets,
            'availableTickets' => $availableTickets,
        ]);
    }

    #[Route('/ticket/{id}', name: 'app_ticket_id')]
    public function show(Ticket $ticket): Response
    {
        $user=$this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket,
            'user'=>$user]);
    }



    #[Route ('/ticket/{id}/delete', name: 'app_ticket_delete',requirements: ['id' => '\d+'])]
    public function delete(Ticket $ticket) :Response
    {return $this->render('ticket/', [
    ]); }
    #[Route ('/ticket/{id}/Update', name: 'app_ticket_update',  requirements: ['id' => '\d+'])]
    public function update(Ticket $ticket) :Response
    {return $this->render('ticket/', [
    ]); }
}
