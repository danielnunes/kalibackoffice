<?php

namespace Kali\Back\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\ProductBundle\Entity\Sender;
use Kali\Back\ProductBundle\Form\Type\SenderType;

/**
 * @Route("/sender")
 */
class SenderController extends Controller {

    /**
     * @Route("/plug/{id}", name="sender_plug", defaults={"id" = "0"})
     * @Template()
     */
    public function plugAction($id, Request $request) {
        if ($id != 0) {
            $sender = $this->getDoctrine()
                    ->getRepository("KaliBackProductBundle:Sender")
                    ->find($id);
        } else {
            $sender = new Sender();
        }
        $form = $this->createForm(new SenderType(), $sender);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sender);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Vos changements ont été sauvegardés!'
            );

            return $this->redirect($this->generateUrl("sender_plug", array("id" => $sender->getId())));
        }

        return array(
            "sender" => $sender,
            "form" => $form->createView(),
        );
    }

    /**
     * @Route("/list", name="sender_list")
     * @Template()
     */
    public function listAction() {
        $senders = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Sender")
                ->findAll();
        
        return array(
            "senders" => $senders,
        );
    }

    /**
     * @Route("/delete/{id}", name="sender_delete")
     * @Template()
     */
    public function deleteAction($id) {
        $sender = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Sender")
                ->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($sender);
        $em->flush();
        return $this->redirect($this->generateUrl("sender_list"));
    }

}
