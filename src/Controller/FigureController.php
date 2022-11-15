<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureType;
use App\Repository\FigureRepository;
use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/figure')]
class FigureController extends AbstractController
{
    #[Route('/', name: 'app_figure_index', methods: ['GET'])]
    public function index(FigureRepository $figureRepository): Response
    {
        $user = $this->getUser();

        return $this->render('figure/index.html.twig', [
            'figures' => $figureRepository->findByAuthor($user),
        ]);
    }

    #[Route('/new', name: 'app_figure_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FigureRepository $figureRepository): Response
    {
        $figure = new Figure();
        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slugger = new AsciiSlugger();
            $figure->setSlug($slugger->slug($figure->getName()));
            $figure->setCreationDate(new \DateTime);
            $user = $this->getUser();
            $figure->setAuthor($user);

            $figureRepository->save($figure, true);

            $this->addFlash('success', 'L\'ajout de votre figure est validée.');
            return $this->redirectToRoute('app_user_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('figure/new.html.twig', [
            'figure' => $figure,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_figure_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Figure $figure, FigureRepository $figureRepository, ImageRepository $imagesRepository, VideoRepository $videoRepository): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $figure);

        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $figure->setUpdateDate(new \DateTime);
            $figureRepository->save($figure, true);

            $this->addFlash('success', 'La modification de votre figure est validée.');

            return $this->redirectToRoute('app_figure_edit', ['id' => $figure->getId()], Response::HTTP_SEE_OTHER);
        }

        $images = $imagesRepository->findBy(['figure' => $figure]);
        $videos = $videoRepository->findBy(['figure' => $figure]);

        return $this->renderForm('figure/edit.html.twig', [
            'figure' => $figure,
            'images' => $images,
            'videos' => $videos,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/{_token}', name: 'app_figure_delete', methods: ['POST', 'GET'])]
    public function delete(Figure $figure, FigureRepository $figureRepository, $_token, ImageRepository $imageRepository): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $figure);

        $images = $imageRepository->findBy(['figure' => $figure]);
        $fileSystem = new Filesystem();

        foreach ($images as $image) {
            $fileSystem->remove($this->getParameter('images_directory') . '/' . $image->getUrl());
        }

        if ($this->isCsrfTokenValid('delete' . $figure->getId(), $_token)) {
            $figureRepository->remove($figure, true);
        }

        $this->addFlash('success', 'La suppression de votre figure est validée.');

        return $this->redirectToRoute('app_user_dashboard', [], Response::HTTP_SEE_OTHER);
    }
}