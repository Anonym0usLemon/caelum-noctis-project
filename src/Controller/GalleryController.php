<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Image;

class GalleryController extends AbstractController
{
    #[Route('/gallery', name: 'gallery')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $galleryRepository = $entityManager->getRepository(Image::class);
        $galleryItems = $galleryRepository->findAll(); 

        return $this->render('gallery/index.html.twig', [
            'controller_name' => 'GalleryController',
            'galleryItems' => $galleryItems,
        ]);
    }
}
