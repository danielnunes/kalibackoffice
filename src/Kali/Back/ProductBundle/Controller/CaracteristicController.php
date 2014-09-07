<?php

namespace Kali\Back\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\ProductBundle\Entity\Caracteristic;
use Kali\Back\ProductBundle\Form\Type\CaracteristicType;

/**
 * @Route("/category")
 */
class CaracteristicController extends Controller {

    /**
     * @Route("/list", name="caracteristic_list")
     * @Template()
     */
    public function listAction() {
        $caracteristics = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Caracteristic")
                ->findAll();
        return array(
            "caracteristics" => $caracteristics,
        );
    }

    /**
     * @Route("/plug/{id}", name="caracteristic_plug", defaults={"id" = "0"})
     * @Template()
     */
    public function plugAction($id, Request $request) {
        if ($id != 0) {
            $caracteristic = $this->getDoctrine()
                    ->getRepository("KaliBackProductBundle:Caracteristic")
                    ->find($id);
        } else {
            $caracteristic = new Caracteristic();
        }
        $form = $this->createForm(new CaracteristicType(), $caracteristic);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($caracteristic);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Vos changements ont été sauvegardés!'
            );

            return $this->redirect($this->generateUrl("caracteristic_plug", array("id" => $caracteristic->getId())));
        }

        return array(
            "caracteristic" => $caracteristic,
            "form" => $form->createView(),
        );
    }

    /**
     * @Route("/delete/{id}", name="caracteristic_delete")
     * @Template()
     */
    public function deleteAction($id) {
         $caracteristic = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Caracteristic")
                ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($caracteristic);
        $em->flush();
        return $this->redirect($this->generateUrl("caracteristic_list"));
    }

}
