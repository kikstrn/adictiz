<?php

namespace App\Controller;

use App\Entity\Files;
use App\Form\FilesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilesController extends AbstractController
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
    ) {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'upload_files')]
    public function upload(Request $request): Response
    {
        $files = new Files();
        $form = $this->createForm(FilesType::class, $files);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFileName = $form['imageFile']->getData();

            if ($uploadedFileName) {
                $fileName = md5(uniqid()).'.'.$uploadedFileName->guessExtension();
                $files->setFileName($fileName);
            }

            $this->entityManager->persist($files);
            $this->entityManager->flush();

            $this->addFlash('success', 'Envoyé avec succès.');

            return $this->redirectToRoute('upload_files');

        }

        return $this->render('files/index.html.twig', [
            'form' => $form,
        ]);
    }
}
