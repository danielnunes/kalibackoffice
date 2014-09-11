<?php

namespace Kali\Rest\RestBundle\Controller;

use DateTime;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\UserBundle\Entity\Client;

class UserController extends Controller {

    public function getUserAction($id) {
        /* @var $userManager UserManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        return $user;
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
        
        return $client;
    }
    
    
    public function getUpdateUserAction($id, $gender, $firstName, $lastName, $address, $birthDate, $postalCode, $city, $phone, $mobilePhone, $email, $password) {
        $em = $this->getDoctrine()->getManager();
        $userManager = $this->get('fos_user.user_manager');
        
        $client = $this->getDoctrine()->getRepository("KaliBackUserBundle:Client")->find($id);

        $user = $client->getUser();
        $client = new Client();

        $user->setUsername($email);
        $user->setPlainPassword($password);
        $user->setEmail($email);
        $user->setEnabled(true);

        $userManager->updateUser($user);

        $gender = $form->get('client')->get("gender")->getData();
        switch ($gender) {
            case 'm' :
                $client->setGender(false);
                break;
            case 'f' :
                $client->setGender(true);
                break;
        }
        $client->setFirstName($firstName);
        $client->setAddress($address);
        $client->setLastName($lastName);
        $client->setPostalCode($postalCode);
        $client->setCity($city);
        $client->setMobilePhone($mobilePhone);
        $client->setPhone($phone);
        $date = new DateTime('NOW');
        $client->setCreateDate($date);
        $client->setBirthDate($birthDate);
        $client->setLastUpdateDate($date);
        $client->setUser($user);

        $em->persist($client);
        $em->flush();
        
        return $client;
    }

}
