<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    #[Route('/ingredient/{id}', name: 'app_view_ingredient')]
    public function viewIngredient(EntityManagerInterface $entityManager, int $id): Response
    {

        $ingredient = $entityManager->getRepository(Ingredient::class)->find($id);

        return $this->render('ingredient/ingredient.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    #[Route('/ingredient-add', name: 'app_add_ingredient')]
    public function addIngredient(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IngredientType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();
            $entityManager->persist($ingredient);
            $entityManager->flush();

            $this->addFlash('success', 'Ingredient is toegevoegd');

            return $this->redirectToRoute('app_ingredient');
        }
        return $this->render('ingredient/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/ingredient-update/{id}', name: 'app_update_ingredient')]
    public function updateIngredient(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $ingredient = $entityManager->getRepository(Ingredient::class)->find($id);
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();
            $entityManager->persist($ingredient);
            $entityManager->flush();

            $this->addFlash('success', 'Ingredient is bijgewerkt');

            return $this->redirectToRoute('app_ingredient');
        }
        return $this->render('ingredient/update.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/ingredient-delete/{id}', name: 'app_delete_ingredient')]
    public function deleteIngredient(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $ingredient = $entityManager->getRepository(Ingredient::class)->find($id);
        $entityManager->remove($ingredient);
        $entityManager->flush();
        $this->addFlash('success', 'Ingredient is verwijderd');
        return $this->redirectToRoute('app_ingredient');
    }
}
