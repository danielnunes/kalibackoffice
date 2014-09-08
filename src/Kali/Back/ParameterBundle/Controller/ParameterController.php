<?php

namespace Kali\Back\ParameterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\ParameterBundle\Entity\Parameter;

class ParameterController extends Controller
{
    /**
     * @Route("parameter")
     * @Template()
     */
    public function IndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $slogan = $em->getRepository("KaliBackParameterBundle:Parameter")
            ->findOneBy(array("name" => "slogan"));

        $description = $em->getRepository("KaliBackParameterBundle:Parameter")
            ->findOneBy(array("name" => "description"));
        $parameters= $em->getRepository('KaliBackParameterBundle:Parameter')->findAll();


        return $this->render('KaliBackParameterBundle:Parameter:index.html.twig', array('parameters' => $parameters, 'slogan' => $slogan, 'description' => $description));

    }


    /**
     * @Route("parameter-edit/{id}", name="parameter_edit")
     *
     */
    public function EditAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $parameters = $em->getRepository('KaliBackParameterBundle:Parameter')->find($id);

        $form = $this->createForm('parameter', $parameters, array('validation_groups' => array('Default')))
            ->add('name', 'slogan')
            ->add('name', 'description')
            ->add('submit', 'submit');

        return $this->render('KaliBackParameterBundle:Parameter:edit.html.twig', array('form' => $form));
        $form->handleRequest($request);
    }
}
