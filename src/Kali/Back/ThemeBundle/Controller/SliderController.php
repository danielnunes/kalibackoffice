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

        if($form0->isValid()){
            $sliderIntermediaire = $form0->getData();
            $slider = $this->getDoctrine()->getRepository("KaliBackImageBundle:Slider")->find($sliderIntermediaire->getId());
            
            $sliderIntermediaire->upload();
            $slider->setPath($sliderIntermediaire->getPath());
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
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
