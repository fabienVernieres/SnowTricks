<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Repository\FigureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FigureRepository $figureRepository): Response
    {
        $user = $this->getUser();

        return $this->render('home/index.html.twig', [
            'figures' => $figureRepository->findAll(),
        ]);
    }


    #[Route('/{id}/trick/{slug}', name: 'app_show', methods: ['GET'])]
    public function show(Figure $figure): Response
    {
        return $this->render('figure/show.html.twig', [
            'figure' => $figure,
        ]);
    }
}