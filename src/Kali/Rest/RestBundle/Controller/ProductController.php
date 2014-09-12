<?php

namespace Kali\Rest\RestBundle\Controller;

use Kali\Back\ProductBundle\Entity\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function getCategoryProductAction($id) {
        $category = $this->getDoctrine()->getRepository("KaliBackProductBundle:Category")->find($id);
        
        $products = $this->getDoctrine()->getManager()
                ->getRepository("KaliBackProductBundle:Product")
                ->findByCat($category);
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
    public function getFinalise(Request $request){
        if ("GET" === $request->getMethod()) {
            $client = $this->getDoctrine()->getRepository("KaliBackUserBundle:Client")->find($request->get("user"));
            $sender = $this->getDoctrine()->getRepository("KaliBackProductBundle:Sender")->find($request->get("sender"));
            $total = $request->get("total");
            $panier = unserialize($request->get("panier"));
            
            $command = new Command();
            $command->setDate(new \DateTime());
            $command->setPrice($total);
            $command->setSender($sender);
            $command->setStatus("Livraison");
            $command->setUser($user);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($command);
            $em->flush();
            
            return $this->redirect("http://front.kali.dev/command/valide");
        }
    }

}
