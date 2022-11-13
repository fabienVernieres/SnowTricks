<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\FigureRepository;
use App\Service\FileUploader;
use App\Repository\ImageRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/image')]
class ImageController extends AbstractController
{
    #[Route('/figure/{figure}', name: 'app_image_figure', methods: ['GET', 'POST'])]
    public function figure(Request $request, ImageRepository $imageRepository, Figure $figure, FileUploader $fileUploader, FigureRepository $figureRepository): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $figure);

        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($figure->getImage() !== null) {
                $oldImage = $figure->getImage();

                $fileSystem = new Filesystem();
                $fileSystem->remove($this->getParameter('images_directory') . '/' . $figure->getImage()->getUrl());
            }

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload('images_directory', $imageFile);
                $image->setUrl($imageFileName);
            }

            $image->setFigure($figure);
            $imageRepository->save($image, true);

            $figure->setImage($image);
            $figureRepository->save($figure, true);

            if (isset($oldImage)) {
                $imageRepository->remove($oldImage, true);
            }

            $this->addFlash('success', 'La modification de votre image à la une est validée.');
            return $this->redirectToRoute('app_figure_edit', ['id' => $figure->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('image/figure.html.twig', [
            'image' => $image,
            'form' => $form,
            'figure' => $figure
        ]);
    }

    #[Route('/edit/{image}', name: 'app_image_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImageRepository $imageRepository, Image $image, FileUploader $fileUploader): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $image->getFigure());

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileSystem = new Filesystem();
            $fileSystem->remove($this->getParameter('images_directory') . '/' . $image->getUrl());

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload('images_directory', $imageFile);
                $image->setUrl($imageFileName);
            }

            $imageRepository->save($image, true);

            $this->addFlash('success', 'La modification de votre image est validée.');
            return $this->redirectToRoute('app_figure_edit', ['id' => $image->getFigure()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('image/edit.html.twig', [
            'image' => $image,
            'form' => $form,
            'figure' => $image->getFigure(),
        ]);
    }

    #[Route('/add/{figure}', name: 'app_image_add', methods: ['GET', 'POST'])]
    public function add(Request $request, ImageRepository $imageRepository, Figure $figure, FileUploader $fileUploader): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $figure);

        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload('images_directory', $imageFile);
                $image->setUrl($imageFileName);
            }

            $image->setFigure($figure);
            $imageRepository->save($image, true);

            $this->addFlash('success', 'L\'ajout de votre image est validée.');
            return $this->redirectToRoute('app_figure_edit', ['id' => $figure->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('image/new.html.twig', [
            'image' => $image,
            'form' => $form,
            'figure' => $figure
        ]);
    }

    #[Route('/{id}', name: 'app_image_show', methods: ['GET'])]
    public function show(Image $image): Response
    {
        return $this->render('image/show.html.twig', [
            'image' => $image,
        ]);
    }

    #[Route('/{id}/{_token}', name: 'app_image_delete', methods: ['GET'])]
    public function delete(Image $image, ImageRepository $imageRepository, $_token): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $image->getFigure());

        $figure = $image->getFigure();
        $fileSystem = new Filesystem();
        $fileSystem->remove($this->getParameter('images_directory') . '/' . $image->getUrl());

        if ($this->isCsrfTokenValid('delete' . $image->getId(), $_token)) {
            $this->addFlash('success', 'La suppression de votre image est validée.');
            $imageRepository->remove($image, true);
        }

        return $this->redirectToRoute('app_figure_edit', ['id' => $figure], Response::HTTP_SEE_OTHER);
    }
}