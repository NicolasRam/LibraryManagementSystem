<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\SubCategory;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="backend_category_index", methods="GET")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('backend/category/index.html.twig', ['categories' => $categoryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="backend_category_new", methods="GET|POST")
     */
    public function save(Request $request): Response
    {
        $category = new Category();

//        $category->addSubCategory( new SubCategory() );

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('backend_category_index');
        }

        return $this->render('backend/category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backend_category_show", methods="GET")
     */
    public function show(Category $category): Response
    {
        return $this->render('backend/category/show.html.twig', ['category' => $category]);
    }

    /**
     * @Route("/{id}/edit", name="backend_category_edit", methods="GET|POST")
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_edit', ['id' => $category->getId()]);
        }

        return $this->render('backend/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backend_category_delete", methods="DELETE")
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('backend_category_index');
    }
}
