<?php

namespace Kali\Rest\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ProductController
 * @package Kali\Rest\RestBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * Service Rest retournant tous les produits.
     * @return array
     */
    public function getAllProductsAction()
    {
        $products = $this->getDoctrine()
            ->getRepository("KaliBackProductBundle:Product")
            ->findAll();

        return $products;
    }

    public function getFeaturedProductsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT * FROM KaliBackProductBundle:Product'
        )->setMaxResults(10);

        return $query;
    }
}