<?php

namespace Kali\Back\CommandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\CommandBundle\Form\Type\CommandFormType;

/**
 * 
 * @Route("/command")
 */
class CommandController extends Controller
{
    /**
     * @Route("/list", name ="command.list")
     * @Template()
     */
    public function listAction()
    {
        $commands = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Command")
                ->findAll();
        
        return array(
            "commands" =>$commands
        );
    }

    /**
     * @Route("/plug/{id}", name = "command_plug")
     * @Template()
     */
    public function plugAction($id, Request $request)
    {
        if ($id != 0) {
            $command = $this->getDoctrine()
                    ->getRepository("KaliBackProductBundle:Command")
                    ->find($id);
        } else {
//            $command = new Command();
            return $this->redirect($this->generateUrl("command.list"));
        }
        $form = $this->createForm(new CommandFormType(), $command);
        if('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $form_array = $request->get($form->getName());
                $em = $this->getDoctrine()->getManager();

                $sender = $em->getRepository("KaliBackProductBundle:Sender")
                                ->findOneBy(array("id" => $form_array['sender']));
                
                    $promotion = $em->getRepository("KaliBackProductBundle:Promotion")
                                ->findOneBy(array("id" => $form_array['sender']));
                if($promotion != null) {
                    $command->setPromotion($promotion);
                }
                
                $command->setSender($sender);
                $em->persist($command);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                        'notice', 'Vos changements ont été sauvegardés!'
                );

                return $this->redirect($this->generateUrl("command.list"));
            }
        }

        return array(
            "command" => $command,
            "form" => $form->createView(),
        );
        
    }
    

    
    
        /**
     * @Route("/delete/{id}", name="command_delete")
     * @Template()
     */
    public function deleteAction($id) {
        $command = $this->getDoctrine()
                ->getRepository("KaliBackProductBundle:Command")
                ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($command);
        $em->flush();
        return $this->redirect($this->generateUrl("command.list", array()));
    }

         
}
