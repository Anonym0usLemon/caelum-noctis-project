<?php

namespace App\Controller;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class GalleryManagementController extends AbstractController
{
    #[Route('/gallery/add', name: 'gallery_add')]
    public function index(
        Request $request, 
        SluggerInterface $slugger,
        #[Autowire('%kernel.project_dir%/public/images')] string $imagesDirectory
        ): Response
    {
        return $this->render('gallery_management/index.html.twig', [
            'controller_name' => 'GalleryManagementController',
        ]);
    }
}
