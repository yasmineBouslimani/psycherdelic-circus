<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Customer;
use App\Form\CommentType;
use App\Form\CustomerType;
use App\Repository\ProgramPriceRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     */
    public function showBuyTicket(ProgramRepository $programRepository, ProgramPriceRepository $programPriceRepository): Response
    {
        return $this->render('ticket.html.twig', [
            'programs' => $programRepository->findAll(),
        ]);
    }


    /**
     * @return Response
     * @Route("/contact", name="contact", methods={"GET","POST"})
     */
    public function contact(Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

}
