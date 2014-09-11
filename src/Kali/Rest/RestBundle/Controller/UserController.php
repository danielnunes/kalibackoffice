<?php

namespace Kali\Rest\RestBundle\Controller;

use DateTime;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\UserBundle\Entity\Client;

class UserController extends Controller {

    public function getUserAction($id) {
        $client = $this->getDoctrine()->getRepository("KaliBackUserBundle:Client")->find($id);
        return $client;
    }

    public function getCreateUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $client = new Client();

        $user->setUsername($request->get("email"));
        $user->setPlainPassword($request->get("password"));
        $user->setEmail($request->get("email"));
        $user->setEnabled(true);

        $userManager->updateUser($user);

        $gender = $request->get("gender");
        switch ($gender) {
            case 'm' :
                $client->setGender(false);
                break;
            case 'f' :
                $client->setGender(true);
                break;
        }
        $client->setFirstName($request->get("firstName"));
        $client->setAddress($request->get("address"));
        $client->setLastName($request->get("lastName"));
        $client->setPostalCode($request->get("postalCode"));
        $client->setCity($request->get("city"));
        $client->setMobilePhone($request->get("mobilePhone"));
        $client->setPhone($request->get("phone"));
        $date = new DateTime('NOW');
        $client->setCreateDate($request->get("date"));
        $client->setBirthDate($request->get("birthDate"));
        $client->setLastUpdateDate($date);
        $client->setUser($user);

        $em->persist($client);
        $em->flush();
        
        return $this->redirect("http://front.kali.dev/new-register/" . $client->getId());
    }
    
    
    public function getUpdateUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userManager = $this->get('fos_user.user_manager');
        
        $client = $this->getDoctrine()->getRepository("KaliBackUserBundle:Client")->find($request->get("id"));

        $user = $client->getUser();

        $user->setUsername($request->get("email"));
        $user->setPlainPassword($request->get("password"));
        $user->setEmail($request->get("email"));
        $user->setEnabled(true);

        $userManager->updateUser($user);

        $gender = $request->get("gender");
        switch ($gender) {
            case 'm' :
                $client->setGender(false);
                break;
            case 'f' :
                $client->setGender(true);
                break;
        }
        $client->setFirstName($request->get("firstName"));
        $client->setAddress($request->get("address"));
        $client->setLastName($request->get("lastName"));
        $client->setPostalCode($request->get("postalCode"));
        $client->setCity($request->get("city"));
        $client->setMobilePhone($request->get("mobilePhone"));
        $client->setPhone($request->get("phone"));
        $date = new DateTime('NOW');
        $client->setCreateDate($request->get("date"));
        $client->setBirthDate($request->get("birthDate"));
        $client->setLastUpdateDate($date);
        $client->setUser($user);

        $em->persist($client);
        $em->flush();
        
        return $this->redirect("http://front.kali.dev/mon-compte/" . $client->getId() . "/1");
    }

}
