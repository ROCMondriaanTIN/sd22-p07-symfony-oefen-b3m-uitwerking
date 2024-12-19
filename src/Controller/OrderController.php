<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
    * Showing all the orders
    */
    #[Route('/orders', name: 'app_orders')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        //Getting all the orders.
        $orders = $entityManager->getRepository(Order::class)->findAll();

        return $this->render('order/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    //Delete an order
    #[Route('/orders/delete/{order}', name: 'app_delete_order')]
    public function delete(EntityManagerInterface $entityManager, Order $order): Response
    {
        $entityManager->remove($order);
        $entityManager->flush();

        $this->addFlash('danger', 'De bestelling is gewist.');

        return $this->redirectToRoute('app_index');
    }

}
