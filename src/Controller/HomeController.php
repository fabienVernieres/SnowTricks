<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Repository\FigureRepository;
use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
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


    #[Route('/trick/{id}/{slug}', name: 'app_show', methods: ['GET'])]
    public function show(Figure $figure, ImageRepository $imageRepository, VideoRepository $videoRepository): Response
    {
        $images = $imageRepository->findBy(['figure' => $figure]);
        $videos = $videoRepository->findBy(['figure' => $figure]);

        return $this->render('figure/show.html.twig', [
            'figure' => $figure,
            'images' => $images,
            'videos' => $videos,
        ]);
    }
}