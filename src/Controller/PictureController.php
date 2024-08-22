<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Picture;
use App\Form\PictureType;

class PictureController extends AbstractController
{
    #[Route('/', name: 'app_picture_upload')]
    public function upload(
        Request $request,
        SluggerInterface $slugger,
        EntityManagerInterface $entityManager
        ): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arrayFiles = $form->get('files')->getData();
            dd($arrayFiles);
            foreach ($arrayFiles as $file) {
                dd($file);
                // On génère un nouveau nom de fichier
                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                // On copie le fichier dans le dossier uploads
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                // On crée l'image dans la base de données
                $picture->setName($file);

                $entityManager->persist($picture);
                $entityManager->flush();

                $this->addFlash('success', 'Envoyé avec succès.');

                return $this->render('picture/index.html.twig', [
                    'form' => $form,
                ]); 
            }
        }

        return $this->render('picture/index.html.twig', [
            'form' => $form,
        ]);
    }
}
