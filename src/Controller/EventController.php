<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/events', name: 'app_events')]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', ['events' => $eventRepository]);
    }
}
