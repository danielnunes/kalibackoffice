<?php

namespace Kali\Rest\UserBundle\Controller;

use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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

    public function getCreateUserAction($gender, $firstName, $lastName, $address, $birthDate, $postalCode, $city, $phone, $mobilePhone, $email, $password) {
        $em = $this->getDoctrine()->getManager();
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $client = new Client();

        $user->setUsername($email);
        $user->setPlainPassword($password);
        $user->setPlainPassword($email);
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
        $date = new \DateTime('NOW');
        $client->setCreateDate($date);
        $client->setBirthDate($birthDate);
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
        $user->setPlainPassword($email);
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
        $date = new \DateTime('NOW');
        $client->setCreateDate($date);
        $client->setBirthDate($birthDate);
        $client->setLastUpdateDate($date);
        $client->setUser($user);

        $em->persist($client);
        $em->flush();
        
        return $client;
    }

}
