<?php

namespace Kali\Back\ProductBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\ProductBundle\Entity\Category;
use Kali\Back\ProductBundle\Form\Type\CategoryType;

/**
 * @Route("/category")
 */
class CategoryController extends Controller {

    /**
     * @Route("/list", name="category_list")
     * @Template()
     */
    public function listAction() {
        $categories = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Category")
                ->findAll();
        
        return array(
            "categories" => $categories,
        );
    }

    /**
     * @Route("/plug/{id}", name="category_plug", defaults={"id" = "0"})
     * @Template()
     */
    public function plugAction($id, Request $request) {
        if ($id != 0) {
            $category = $this->getDoctrine()
                    ->getRepository("KaliBackProductBundle:Category")
                    ->find($id);
        } else {
            $category = new Category();
        }
        $form = $this->createForm(new CategoryType(), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($category);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Vos changements ont été sauvegardés!'
            );

            return $this->redirect($this->generateUrl("category_list"));
        }

        return array(
            "category" => $category,
            "form" => $form->createView(),
        );
    }

    /**
     * @Route("/delete/{id}", name="category_delete")
     * @Template()
     */
    public function deleteAction($id) {
        $category = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Category")
                ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        return $this->redirect($this->generateUrl("category_list"));
    }

}
