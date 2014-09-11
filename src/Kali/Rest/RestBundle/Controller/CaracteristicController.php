<?php

namespace Kali\Rest\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CaracteristicController extends Controller
{
    public function getCaracteristicAction($id)
    {
        $product = $this->getDoctrine()->getRepository("KaliBackProductBundle:Product")->find($id);
        $caracteristics = $this->getDoctrine()
            ->getRepository("KaliBackProductBundle:Caracteristic")
            ->findByProduct($product);

        return $caracteristics;
    }
}