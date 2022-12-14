<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
use App\Repository\FigureRepository;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FigureRepository $figureRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'figures' => $figureRepository->findBy([], ['id' => 'DESC']),
        ]);
    }


    #[Route('/trick/{id}/{slug}', name: 'app_show', methods: ['POST', 'GET'])]
    public function show(Figure $figure, ImageRepository $imageRepository, VideoRepository $videoRepository, Request $request, CommentRepository $commentRepository): Response
    {
        $images = $imageRepository->findBy(['figure' => $figure]);
        $videos = $videoRepository->findBy(['figure' => $figure]);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreationDate(new \DateTime);
            $user = $this->getUser();
            $comment->setAuthor($user);
            $comment->setFigure($figure);
            $commentRepository->save($comment, true);

            $this->addFlash('success', 'L\'ajout de votre commentaire est validé.');
        }

        $comments = $commentRepository->findBy(['figure' => $figure], ['creationDate' => 'DESC']);

        return $this->render('figure/show.html.twig', [
            'figure' => $figure,
            'images' => $images,
            'videos' => $videos,
            'comment' => $comment,
            'form' => $form->createView(),
            'comments' => $comments,
        ]);
    }
}