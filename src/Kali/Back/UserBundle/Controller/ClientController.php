<?php

namespace Kali\Back\UserBundle\Controller;

use FOS\UserBundle\Model\UserManager;
use Kali\Back\UserBundle\Form\Type\ClientFormType;
use Kali\Back\UserBundle\Form\Type\ClientUserFormType;
use Kali\Back\UserBundle\Form\Type\ClientUserEditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Kali\Back\UserBundle\Entity\Client;

/**
 * Class ClientController
 * @package Kali\Back\UserBundle\Controller
 * @Route("/client")
 */
class ClientController extends Controller
{
    
    /**
     * 
     * @Route("/list", name = "client.list")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $userClients = $em->getRepository("KaliBackUserBundle:Client")
                            ->findAll();
        return array("userClients" => $userClients);
    }
    
    
    /**
     * 
     * @Route("/create", name = "client.create")
     * @Template()
     */
    public function newAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        /* @var $userManager UserManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $client = new Client();

        /* Création du formulaire */
        $form = $this->createForm(new ClientUserFormType(), $user);

        /* Récupération de la requête */
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                if($form->get("email")->getData()) {
                    $user->setUsername($form->get("email")->getData());
                }
                if($form->get("plainPassword")->getData()) {
                    $user->setPlainPassword($form->get("plainPassword")->getData());
                }
                if($request->get("email")) {
                    $user->setPlainPassword($request->get("email"));
                }
                
                $user->setEnabled(true);

                $userManager->updateUser($user);
                
                if($form->get('client')->get("gender")) {
                    $gender = $form->get('client')->get("gender")->getData();
                    switch ($gender) {
                        case 'm' :
                            $client->setGender(false);
                            break;
                        case 'f' :
                            $client->setGender(true);
                            break;
                    }
                }
                $client->setFirstName($form->get('client')->get('firstName')->getData());
                $client->setAddress($form->get('client')->get('address')->getData());
                $client->setLastName($form->get('client')->get('lastName')->getData());
                $client->setPostalCode($form->get('client')->get('postalCode')->getData());
                $client->setCity($form->get('client')->get('city')->getData());
                $client->setMobilePhone($form->get('client')->get('mobilePhone')->getData());
                $client->setPhone($form->get('client')->get('phone')->getData());
                $date = new \DateTime('NOW');
                $client->setCreateDate($date);

                if($form->get('client')->get('birthDate')->getData()) {    
                    $client->setBirthDate($form->get('client')->get('birthDate')->getData());
                }
                $client->setLastUpdateDate($date);
                $client->setUser($user);
                
                $em->persist($client);
                $em->flush();

                // On définit un message flash
                $this->get('session')->getFlashBag()->add('notice', 'Utilisateur créé avec succès');

                return $this->redirect($this->generateUrl('client.list'));
            }
        }
        return array('form' => $form->createView());
    }
    
    /**
     * Formulaire de modification d'un client.
     * @Route("/edit/{id}", name="client.edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /* @var $userManager UserManager */
        $userManager = $this->get('fos_user.user_manager');
//        $user = $userManager->findUserBy(array('id' => $id));
        $client = $em->getRepository("KaliBackUserBundle:Client")
                    ->findOneBy(array("id" => $id));
        $user = $client->getUser();

        /* Création du formulaire */
        $form = $this->createForm(new ClientUserEditFormType(), $client);
        $date = new \DateTime('NOW');
        /* Récupération de la requête */
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
//            $form->submit($request);
            $form->handleRequest($request);
            if ($form->isValid()) {
//                return new Response("ok");
                
                $user->setUsername($request->get("email"));
                $user->setEnabled($request->get("enabled"));
                $userManager->updateUser($user);
                
                if($form->get('client')->get("gender")) {
                    $gender = $form->get('client')->get("gender")->getData();
                    switch ($gender) {
                        case 'm' :
                            $client->setGender(false);
                            break;
                        case 'f' :
                            $client->setGender(true);
                            break;
                    }
                }
                $client->setFirstName($form->get('client')->get('firstName')->getData());
                $client->setAddress($form->get('client')->get('address')->getData());
                $client->setLastName($form->get('client')->get('lastName')->getData());
                $client->setPostalCode($form->get('client')->get('postalCode')->getData());
                $client->setCity($form->get('client')->get('city')->getData());
                $client->setMobilePhone($form->get('client')->get('mobilePhone')->getData());
                $client->setPhone($form->get('client')->get('phone')->getData());
                
                $date = new \DateTime('NOW');
                $client->setCreateDate($date);
                if($form->get('client')->get('birthDate')->getData()) {    
                    $client->setBirthDate($form->get('client')->get('birthDate')->getData());
                }

                $client->setLastUpdateDate($date);
                $client->setUser($user);
                
                $em->persist($client);
                $em->persist($user);
                $em->flush();

                // On définit un message flash
                $this->get('session')->getFlashBag()->add('notice', 'Utilisateur modifié avec succès');

                return $this->redirect($this->generateUrl('client.list'));
            }
        }
        return array('form' => $form->createView(), 'client' => $client);
    }
    
    /**
     * @Route("/delete/{id}", name="client.delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        /* @var $userManager UserManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));

        $userManager->deleteUser($user);

        // On définit un message flash
        $this->get('session')->getFlashBag()->add('notice', 'Client supprimé avec succès');

        return $this->redirect($this->generateUrl('client.list'));
    }

}


