<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\FigureRepository;
use App\Service\FileUploader;
use App\Repository\UserRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/dashboard', name: 'app_user_dashboard', methods: ['GET', 'POST'])]
    public function dashboard(FigureRepository $figureRepository): Response
    {
        $user = $this->getUser();

        return $this->renderForm('user/dashboard.html.twig', [
            'user' => $user,
            'figures' => $figureRepository->findByAuthor($user),
        ]);
    }

    #[Route('/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository, FileUploader $fileUploader): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $avatarFile */
            $avatarFile = $form->get('avatar')->getData();

            if ($avatarFile) {
                if ($user->getAvatar()) {
                    $fileSystem = new Filesystem();
                    $fileSystem->remove($this->getParameter('avatars_directory') . '/' . $user->getAvatar());
                }

                $avatarFilename = $fileUploader->upload('avatars_directory', $avatarFile);
                $user->setAvatar($avatarFilename);
            }

            $this->addFlash('success', 'Modification de votre profil validée.');
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}