<?php

namespace Kali\Back\ParameterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\ParameterBundle\Entity\Parameter;
use Kali\Back\ParameterBundle\Form\Type\ParameterType;

class ParameterController extends Controller
{
    /**
     * @Route("parameters", name="parameters")
     * @Template()
     */
    public function IndexAction()
    {
        $parameters = $this->getDoctrine()
                            ->getRepository("KaliBackParameterBundle:Parameter")
                            ->findAll();


        $file = 'http://back.kali.dev/img/logo.png';

        return array(
            "parameters" => $parameters,
            "image_url" => $file
        );

    }


    /**
     * @Route("parameter-edit/{id}", name="parameter-edit")
     *
     */
    public function EditAction($id, Request $request)
    {
        if ($id != 0) {
            $parameters = $this->getDoctrine()
                ->getRepository("KaliBackParameterBundle:Parameter")
                ->find($id);

        } else {
            $parameters = new Parameter();

        }
        $file = 'http://back.kali.dev/img/logo.png';

        $form = $this->createForm(new ParameterType(), $parameters);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parameters);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice', 'Vos changements ont été sauvegardés!'
            );

        }
        return $this->render('KaliBackParameterBundle:Parameter:nouveau.html.twig', array('form' => $form->createView(), 'image_url' => $file, 'id' => $parameters ->getId()));
    }

}
