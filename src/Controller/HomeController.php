<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * basic home/ start route.
     */
    #[Route('/', name: 'app_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        //Getting all the categories
        $categories = $entityManager->getRepository(Category::class)->findAll();

        //Returning the rendered route with the categories
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
