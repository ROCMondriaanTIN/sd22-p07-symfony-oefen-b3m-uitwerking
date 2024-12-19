<?php

namespace App\Controller;

use App\Entity\Laptop;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LaptopController extends AbstractController
{
    #[Route('/laptop', name: 'app_laptop')]
    public function index(EntityManagerInterface $em): Response
    {

        $laptops = $em->getRepository(Laptop::class)->findAll();

        return $this->render('laptop/index.html.twig', [
            'laptops' => $laptops,
        ]);
    }

    #[Route('/laptop/{id}', name: 'app_laptop_detail')]
    public function showLaptop(EntityManagerInterface $em, int $id): Response
    {

        $laptop = $em->getRepository(Laptop::class)->find($id);

        return $this->render('laptop/index-detail.html.twig', [
            'laptop' => $laptop,
        ]);
    }
}
