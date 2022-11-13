<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureType;
use App\Service\FileUploader;
use App\Repository\FigureRepository;
use App\Repository\ImageRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
    public function new(Request $request, FigureRepository $figureRepository, FileUploader $fileUploader): Response
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
            return $this->redirectToRoute('app_figure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('figure/new.html.twig', [
            'figure' => $figure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/trick-{slug}', name: 'app_figure_show', methods: ['GET'])]
    public function show(Figure $figure): Response
    {
        return $this->render('figure/show.html.twig', [
            'figure' => $figure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_figure_edit', methods: ['GET', 'POST'])]
    /**
     * @IsGranted("POST_EDIT", subject="figure")
     *
     */
    public function edit(Request $request, Figure $figure, FigureRepository $figureRepository, FileUploader $fileUploader, ImageRepository $imagesRepository): Response
    {
        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $figureRepository->save($figure, true);

            $this->addFlash('success', 'La modification de votre figure est validée.');

            return $this->redirectToRoute('app_figure_edit', ['id' => $figure->getId()], Response::HTTP_SEE_OTHER);
        }

        $images = $imagesRepository->findBy(['figure' => $figure]);

        return $this->renderForm('figure/edit.html.twig', [
            'figure' => $figure,
            'images' => $images,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/{_token}', name: 'app_figure_delete', methods: ['POST', 'GET'])]
    /**
     * @IsGranted("POST_EDIT", subject="figure")
     *
     */
    public function delete(Figure $figure, FigureRepository $figureRepository, $_token): Response
    {
        if ($figure->getImage()) {
            $fileSystem = new Filesystem();
            $fileSystem->remove($this->getParameter('images_directory') . '/' . $figure->getImage()->getUrl());
        }

        if ($this->isCsrfTokenValid('delete' . $figure->getId(), $_token)) {
            $figureRepository->remove($figure, true);
        }

        $this->addFlash('success', 'La suppression de votre figure est validée.');

        return $this->redirectToRoute('app_figure_index', [], Response::HTTP_SEE_OTHER);
    }
}