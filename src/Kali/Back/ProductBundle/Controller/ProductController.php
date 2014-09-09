<?php

namespace Kali\Back\ProductBundle\Controller;

use Kali\Back\ImageBundle\Entity\Picture;
use Kali\Back\ProductBundle\Entity\Product;
use Kali\Back\ProductBundle\Form\Type\CaracteristicProductType;
use Kali\Back\ProductBundle\Form\Type\CategoryProductType;
use Kali\Back\ImageBundle\Form\Type\PictureType;
use Kali\Back\ProductBundle\Form\Type\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/product")
 */
class ProductController extends Controller {

    /**
     * @Route("/plug/{id}", name="product_plug", defaults={"id" = "0"})
     * @Template()
     */
    public function plugAction($id, Request $request) {
        if ($id != 0) {
            $product = $this->getDoctrine()
                    ->getRepository("KaliBackProductBundle:Product")
                    ->find($id);
        } else {
            $product = new Product();
        }
        $form = $this->createForm(new ProductType(), $product);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Vos changements ont été sauvegardés!'
            );

            return $this->redirect($this->generateUrl("product_list"));
        }

        return array(
            "product" => $product,
            "form" => $form->createView(),
        );
    }

    /**
     * @Route("/gallery/{id}", name="product_gallery")
     * @Template()
     */
    public function pictureAction($id, Request $request) {
        $product = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Product")
                ->find($id);

        $pictures = $this->getDoctrine()
                ->getRepository("KaliBackImageBundle:Picture")
                ->galleryProduct($product);

        $picture = new Picture();

        $form = $this->createForm(new PictureType(), $picture);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $picture->setProduct($product);
            if (count($pictures) == 0)
                $picture->setOne(1);
            $picture->upload();
            $em->persist($picture);
            $em->flush();
            return $this->redirect($this->generateUrl("product_gallery", array("id" => $product->getId())));
        }

        return array(
            "product" => $product,
            "form" => $form->createView(),
            "pictures" => $pictures,
        );
    }

    /**
     * @Route("/category/{id}", name="product_category")
     * @Template()
     */
    public function categoryAction($id, Request $request) {
        $product = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Product")
                ->find($id);

        $form = $this->createForm(new CategoryProductType(), $product);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Vos changements ont été sauvegardés!'
            );
            return $this->redirect($this->generateUrl("product_category", array("id" => $product->getId())));
        }


        return array(
            "product" => $product,
            "form" => $form->createView(),
        );
    }

    /**
     * @Route("/caracteristic/{id}", name="product_caracteristic")
     * @Template()
     */
    public function caracteristicAction($id, Request $request) {
        $product = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Product")
                ->find($id);

        $form = $this->createForm(new CaracteristicProductType(), $product);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Vos changements ont été sauvegardés!'
            );
            return $this->redirect($this->generateUrl("product_caracteristic", array("id" => $product->getId())));
        }


        return array(
            "product" => $product,
            "form" => $form->createView(),
        );
    }

    /**
     * @Route("/list", name="product_list")
     * @Template()
     */
    public function listAction() {
        $products = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Product")
                ->findAll();
        
        return array(
            "products" =>$products
        );
    }

    /**
     * @Route("/delete/{id}", name="product_delete")
     * @Template()
     */
    public function deleteAction($id) {
        $product = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Product")
                ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirect($this->generateUrl("product_list", array()));
    }

}
