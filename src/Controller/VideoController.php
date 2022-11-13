<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/video')]
class VideoController extends AbstractController
{
    #[Route('/new/{figure}', name: 'app_video_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VideoRepository $videoRepository, Figure $figure): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $figure);

        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $video->setFigure($figure);
            $videoRepository->save($video, true);

            $this->addFlash('success', 'L\'ajout de votre vidéo est validée.');
            return $this->redirectToRoute('app_figure_edit', ['id' => $figure->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('video/new.html.twig', [
            'video' => $video,
            'form' => $form,
            'figure' => $figure,
        ]);
    }

    #[Route('/{id}', name: 'app_video_show', methods: ['GET'])]
    public function show(Video $video): Response
    {
        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Video $video, VideoRepository $videoRepository): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $video->getFigure());

        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videoRepository->save($video, true);

            $this->addFlash('success', 'La modification de votre vidéo est validée.');
            return $this->redirectToRoute('app_figure_edit', ['id' => $video->getFigure()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('video/edit.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}/{_token}', name: 'app_video_delete', methods: ['GET'])]
    public function delete(Request $request, Video $video, VideoRepository $videoRepository, $_token): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $video->getFigure());

        if ($this->isCsrfTokenValid('delete' . $video->getId(), $_token)) {
            $this->addFlash('success', 'La suppression de votre vidéo est validée.');
            $videoRepository->remove($video, true);
        }

        return $this->redirectToRoute('app_figure_edit', ['id' => $video->getFigure()], Response::HTTP_SEE_OTHER);
    }
}