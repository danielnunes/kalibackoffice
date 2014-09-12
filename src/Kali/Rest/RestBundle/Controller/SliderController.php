<?php

namespace Kali\Rest\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SliderController extends Controller
{
    public function getSlidersAction()
    {
        $sliders = $this->getDoctrine()
            ->getRepository("KaliBackImageBundle:Slider")
            ->findAll();

        return $sliders;
    }
    public function getParametersAction()
    {
        $parameter = $this->getDoctrine()
            ->getRepository("KaliBackParameterBundle:Parameter")
            ->find(1);

        return $parameter;
    }
}