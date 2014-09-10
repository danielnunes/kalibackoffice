<?php

namespace Kali\Rest\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ProductController
 * @package Kali\Rest\RestBundle\Controller
 */
class ProductController extends Controller {

    /**
     * Service Rest retournant tous les produits.
     * @return array
     */
    public function getAllProductsAction() {
        $products = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Product")
                ->findAll();

        return $products;
    }

    /**
     * Service Rest retournant tous les produits.
     * @return array
     */
    public function getFeatureProductsAction() {
        $products = $this->getDoctrine()->getManager()
                ->getRepository("KaliBackProductBundle:Product")
                ->findPopular();

        return $products;
    }
    
    /**
     * Service Rest retournant tous les produits.
     * @return array
     */
    public function getCategoryProductsAction($category) {
        $products = $this->getDoctrine()->getManager()
                ->getRepository("KaliBackProductBundle:Product")
                ->findByCategory(urldecode($category));

        return $products;
    }
    
        
    /**
     * Service Rest retournant tous les produits.
     * @return array
     */
    public function getProductAction($id) {
        $products = $this->getDoctrine()->getManager()
                ->getRepository("KaliBackProductBundle:Product")
                ->find($id);

        return $products;
    }

}
