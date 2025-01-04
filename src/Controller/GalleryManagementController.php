<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class GalleryManagementController extends AbstractController
{
    #[Route('/gallery/add', name: 'gallery_add')]
    public function add(Request $request, FileUploader $fileUploader, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response 
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image); 
        
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('imageFile')->getData(); 

            if ($uploadedFile) {
                $newFilename = $fileUploader->upload($uploadedFile); 
                $image->setFilename($newFilename); 
            }

            $entityManager->persist($image); 
            $entityManager->flush(); 

            return $this->redirectToRoute('gallery');
        }

        return $this->render('gallery_management/index.html.twig', [
            'form' => $form->createView(), 
        ]);
    }
}
