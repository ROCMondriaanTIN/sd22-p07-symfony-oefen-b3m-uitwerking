<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\OrderType;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    //Showing one product together with an order form
    #[Route('/product/{product}', name: 'app_product')]
    public function index(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        //Getting the form OrderType
        $form = $this->createForm(OrderType::class);
        $form->handleRequest($request);

        //If form is submitted and valid, we are going to process the form
        if ($form->isSubmitted() && $form->isValid()) {
            //Getting the data, and make an Order Entity of the data
            $order = $form->getData();

            //Processing the price based on the chosen size of the pizza
            $extraPrice = 0;
            if ($order->getSize() === 'large') {
                $extraPrice = 4;
            } elseif ($order->getSize() === 'medium') {
                $extraPrice = 2;
            } elseif ($order->getSize() === 'small') {
                $extraPrice = -1;
            }

            //Setting the price of the order
            $order->setOrderPrice($product->getPrice() + $extraPrice);
            //Setting the chosen pizza on the order
            $order->setProduct($product);

            //Saving the information in the database
            $entityManager->persist($order);
            $entityManager->flush();

            //Setting a flash-message
            $this->addFlash('success', 'De pizza is besteld! We zijn er waarschijnlijk wel snel');

            //Returning a redirect to the index/ home site
            return $this->redirectToRoute('app_index');
        }

        //If the form was not submitted or valid, show the order page
        return $this->render('product/order.html.twig', [
            'pizza' => $product,
            'form' => $form
        ]);
    }
}
