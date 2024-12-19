<?php

namespace App\Controller;

use App\Entity\Product;
use App\Object\ShoppingCartProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCartController extends AbstractController
{
    #[Route('/shopping/cart', name: 'app_shopping_cart')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $products = $session->get('shopping_cart');

        $totalPrice = 0;

        foreach ($products as $shoppingCartProduct){
            $totalPrice = $totalPrice + ($shoppingCartProduct->getQuantity() * $shoppingCartProduct->getProduct()->getPrice());
        }

        return $this->render('shopping_cart/index.html.twig', [
            'products' => $products,
            'totalPrice' => $totalPrice
        ]);
    }

    #[Route('/shopping/cart/add/{id}', name: 'app_add_shopping_cart')]
    public function add(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $product = $em->getRepository(Product::class)->find($id);
        $session = $request->getSession();
        if(!$session->get('shopping_cart')){
            $session->set('shopping_cart', []);
        }
        $shoppingCart = $session->get('shopping_cart');
        $productExists = false;
        $shoppingCartProduct = null;
        foreach ($shoppingCart as $shoppingCartProduct){
            if($shoppingCartProduct->getProduct()->getId() === $id){
                $shoppingCartProduct->setQuantity($shoppingCartProduct->getQuantity() + 1);
                $productExists = true;
            }
        }
        if(!$productExists){
            $shoppingCartProduct = new ShoppingCartProduct();
            $shoppingCartProduct->setProduct($product);
            $shoppingCartProduct->setQuantity(1);
            $shoppingCart[] = $shoppingCartProduct;
        }

        $session->set('shopping_cart', $shoppingCart);
        $this->addFlash('success', 'Product is toegevoegd aan de winkelwagen');
        return $this->redirectToRoute('app_category_products', ['category' => $product->getCategory()->getId()]);
    }

    #[Route('/shopping/cart/delete/{id}', name: 'delete_cart_product')]
    public function deleteCartProduct(Request $request, int $id): Response
    {
        $session = $request->getSession();
        $products = $session->get('shopping_cart');

        $index = 0;
        $count = 0;

        foreach ($products as $product) {
            if ($product->getId()==$id){
                $index = $count;
            }
            $count++;
        }

        array_splice($products, $index, 1);
        $session->set('shopping_cart', $products);

        return $this->redirectToRoute('app_shopping_cart');
    }

    #[Route('/shopping/cart/delete-all', name: 'delete_cart_product_all')]
    public function destroyCart(Request $request): Response
    {
        $session = $request->getSession();

        $session->set('shopping_cart', []);

        return $this->redirectToRoute('app_shopping_cart');
    }


}
