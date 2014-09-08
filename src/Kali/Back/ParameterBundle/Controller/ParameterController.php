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
     * @Route("parameters", name="parameters")
     * @Template()
     */
    public function IndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $slogan = $em->getRepository("KaliBackParameterBundle:Parameter")
            ->findOneBy(array("name" => "slogan"));

        $description = $em->getRepository("KaliBackParameterBundle:Parameter")
            ->findOneBy(array("name" => "description"));

        $logo = $em->getRepository("KaliBackParameterBundle:Parameter")
            ->findOneBy(array("name" => "logo"));

        $parameters= $em->getRepository('KaliBackParameterBundle:Parameter')->findAll();


        return $this->render('KaliBackParameterBundle:Parameter:index.html.twig', array('parameters' => $parameters, 'slogan' => $slogan, 'description' => $description, 'logo' => $logo));

    }


    /**
     * @Route("parameter-edit/{id}", name="parameter-edit")
     *
     */
    public function EditAction(Parameter $parameter)
    {

        $em = $this->getDoctrine()->getManager();
  /*
        $parameters = $em->getRepository('KaliBackParameterBundle:Parameter')->find($id);

        $form = $this->createForm('parameter', $parameters, array('validation_groups' => array('Default')))
            ->add('name', 'slogan')
            ->add('name', 'description')
            ->add('name', 'logo')
            ->add('submit', 'submit');

        return $this->render('KaliBackParameterBundle:Parameter:edit.html.twig', array('form' => $form));
        $form->handleRequest($request);

        */
        $form = $this->createFormBuilder($parameter)
            ->setRequired(false)
            ->setAction($this->generateUrl('parameters'))
            ->setMethod('GET')
            ->add('name', 'text', array('label' => 'Slogan'))
            ->add('value', 'text', array('label' => 'Description'))
            ->add('valider', 'submit')

            ->getForm();

        if ($form->isValid()){

            $em->flush();
            return $this->redirect($this->generateUrl('nouveau', array('form' => $form->createView())
            ));
        }

        return $this->render('KaliBackParameterBundle:Parameter:nouveau.html.twig', array('form' => $form->createView()
        ));




    }
}
