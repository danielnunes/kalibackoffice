<?php

namespace Kali\Back\ThemeBundle\Controller;

use Kali\Back\ImageBundle\Form\Type\SliderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/slider")
 */
class SliderController extends Controller
{
    /**
     * @Route("/plug", name="slider_plug")
     * @Template()
     */
    public function plugAction(Request $request)
    {
        $sliders = $this->getDoctrine()
                ->getRepository("KaliBackImageBundle:Slider")
                ->findAll();
        
        $form0 = $this->createForm(new SliderType(), $sliders[0]);
        $form1 = $this->createForm(new SliderType(), $sliders[1]);
        $form2 = $this->createForm(new SliderType(), $sliders[2]);
        
        $form0->handleRequest($request);
        $form1->handleRequest($request);
        $form2->handleRequest($request);
        
        if($form0->isValid()){
            $slider0 = $form0->getData();
            
            $slider0->upload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider0);
            $em->flush();
            return $this->redirect($this->generateUrl("slider_plug"));
        }
        
        if($form1->isValid()){
            $slider1 = $form1->getData();
            
            $slider1->upload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider1);
            $em->flush();
            return $this->redirect($this->generateUrl("slider_plug"));
        }
        
        if($form0->isValid()){
            $slider2 = $form2->getData();
            
            $slider2->upload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider2);
            $em->flush();
            return $this->redirect($this->generateUrl("slider_plug"));
        }
        
        return array(
            'sliders' => $sliders,
            'form0' => $form0->createView(),
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
        );
    }

}
