<?php

namespace Kali\Back\ProductBundle\Controller;

use Kali\Back\ProductBundle\Entity\Promotion;
use Kali\Back\ProductBundle\Form\Type\PromotionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/promotion")
 */
class PromotionController extends Controller {

    /**
     * @Route("/list", name="promotion_list")
     * @Template()
     */
    public function listAction() {
        $promotions = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Promotion")
                ->listPromotionDisponible();

        return array(
            'promotions' => $promotions,
        );
    }

    /**
     * @Route("/plug/{id}", name="promotion_plug", defaults={"id" = "0"})
     * @Template()
     */
    public function plugAction($id, Request $request) {
        if ($id != 0) {
            $promotion = $this->getDoctrine()
                    ->getRepository("KaliBackProductBundle:Promotion")
                    ->find($id);
        } else {
            $promotion = new Promotion();
        }
        $form = $this->createForm(new PromotionType(), $promotion);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($promotion);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Vos changements ont été sauvegardé!'
            );

            return $this->redirect($this->generateUrl("promotion_plug", array("id" => $promotion->getId())));
        }

        return array(
            "promotion" => $promotion,
            "form" => $form->createView(),
        );
    }

    /**
     * @Route("/delete/{id}", name="promotion_delete")
     * @Template()
     */
    public function deleteAction($id) {
        $promotion = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Promotion")
                ->find($id);
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($promotion);
        $em->flush();
        return $this->redirect($this->generateUrl("promotion_list"));
    }


}
