<?php


namespace App\Controller;


use App\Repository\ProgramPriceRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="user_index", methods={"GET"})
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @return Response
     * @Route("/calendar", name="calendar_show", methods={"GET"})
     */
    public function showCalendrier(ProgramRepository $programRepository): Response
    {
        return $this->render('program/calendar.html.twig', [
                'programs' => $programRepository->findAll(),
        ]);
    }

    /**
     * @Route("/history", name="history_index", methods={"GET"})
     * @return Response
     */
    public function showHistory(): Response
    {
        return $this->render('history.html.twig');
    }

    /**
     * @return Response
     * @Route("/ticket", name="ticket_index", methods={"GET","POST"})
     *
     */
    public function showBuyTicket(ProgramRepository $programRepository, ProgramPriceRepository $programPriceRepository): Response
    {
        return $this->render('ticket.html.twig', [
            'programs' => $programRepository->findAll(),
        ]);
    }


}
