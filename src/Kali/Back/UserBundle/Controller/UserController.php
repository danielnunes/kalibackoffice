<?php

namespace Kali\Back\UserBundle\Controller;

use FOS\UserBundle\Model\UserManager;
use Kali\Back\UserBundle\Form\Type\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Kali\Back\UserBundle\Controller
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * @Route("/list", name="user.list")
     * @Template()
     */
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return array('users' => $users);
    }

    /**
     * Formulaire de création d'un nouvel utilisateur.
     * @Route("/create", name="user.create")
     * @Template()
     */
    public function newAction()
    {
        /* @var $userManager UserManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();

        /* Création du formulaire */
        $form = $this->createForm(new UserFormType(), $user);

        /* Récupération de la requête */
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $user->setUsername($form->get("email")->getData());
                $user->setPlainPassword($form->get("plainPassword")->getData());
                $user->setEnabled(true);

                $userManager->updateUser($user);

                // On définit un message flash
                $this->get('session')->getFlashBag()->add('notice', 'Utilisateur créé avec succès');

                return $this->redirect($this->generateUrl('user.list'));
            }
        }
        return array('form' => $form->createView());
    }

    /**
     * Formulaire de modification d'un utilisateur.
     * @Route("/edit/{id}", name="user.edit")
     * @Template()
     */
    public function editAction($id)
    {
        /* @var $userManager UserManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));

        /* Création du formulaire */
        $form = $this->createForm(new UserFormType(), $user);

        /* Récupération de la requête */
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $user->setUsername($form->get("email")->getData());
                $user->setPlainPassword($form->get("plainPassword")->getData());

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // On définit un message flash
                $this->get('session')->getFlashBag()->add('notice', 'Utilisateur modifié avec succès');

                return $this->redirect($this->generateUrl('user.list'));
            }
        }
        return array('form' => $form->createView());
    }

    /**
     * @Route("/delete/{id}", name="user.delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        /* @var $userManager UserManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));

        $userManager->deleteUser($user);

        // On définit un message flash
        $this->get('session')->getFlashBag()->add('notice', 'Utilisateur supprimé avec succès');

        return $this->redirect($this->generateUrl('user.list'));
    }
}