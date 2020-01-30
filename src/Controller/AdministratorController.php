<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministratorController extends AbstractController
{
    /**
     * @Route("/admin", name="administrator")
     */
    public function index()
    {
        return $this->render('administrator/index.html.twig', [
            'controller_name' => 'AdministratorController',
        ]);
    }

    /**
     * @param ProgramRepository $programRepository
     * @return Response
     * @Route("/admin/show/program", name="program_index_admin", methods={"GET"})
     */
    public function showProgramAdmin(ProgramRepository $programRepository): Response
    {
        return $this->render('administrator/shows.html.twig', [
            'programs' => $programRepository->findAll(),
        ]);
    }


    /**
     * @param ArtistRepository $artistRepository
     * @return Response
     * @Route("/admin/show/artists", name="artist_index_admin", methods={"GET"})
     */
    public function showArtistAdmin(ArtistRepository $artistRepository): Response
    {
        return $this->render('administrator/artists.html.twig', [
            'artists' => $artistRepository->findAll(),
        ]);
    }

    /**
     * @return Response
     * @Route("/admin/show/category", name="category_index_admin", methods={"GET"})
     */
    public function showCategoryAdmin(CategoryRepository $categoryRepository): Response
    {
        return $this->render('administrator/categories.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

}
