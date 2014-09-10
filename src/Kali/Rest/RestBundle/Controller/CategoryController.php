<?php

namespace Kali\Rest\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
    public function getAllCategoryAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository("KaliBackProductBundle:Category")
            ->findAll();

        return $categories;
    }
}