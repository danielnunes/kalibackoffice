<?php

namespace Kali\Rest\RestBundle\Controller;

use DateTime;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\UserBundle\Entity\Client;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken as Token;


class UserController extends Controller {

    public function getUserAction($id) {
        $client = $this->getDoctrine()->getRepository("KaliBackUserBundle:Client")->find($id);
        return $client;
    }
    
    
    public function getloginAction(Request $request) {
        
            if ("GET" === $request->getMethod()) {
                $em = $this->getDoctrine()->getManager();
                $pass = $request->get("_password");
                $user = $em->getRepository("KaliBackUserBundle:User")
                        ->findOneBy(array("email" => $request->get('_username')));

                /* if user exists */
                if ($user) {

                    $salt = $user->getSalt();
                    $passData = $user->getPassword();
                    $iterations = 5000;
                    $result = '';
                    $salted = $pass . '{' . $salt . '}';

                    $digest = hash('sha512', $salted, true);

                    /* encrypts the password in sha512 */
                    for ($i = 1; $i < $iterations; $i++) {
                        $digest = hash('sha512', $digest . $salted, true);
                    }
                    $cryptedPass = base64_encode($digest);
                    /* if the passwords match */
                    if ($cryptedPass == $passData) {
                        $token = new Token($user, $user->getPassword(), 'fos_userbundle', $user->getRoles());
                        $client = $em->getRepository("KaliBackUserBundle:Client")->findOneBy(array("user" => $user));
                        
                        /* return client and token */
                        return $this->redirect("http://front.kali.dev/check_login/" . $client->getId());  
                    }
                    else {
                        return $this->redirect("http://front.kali.dev/connexion/0");
                    }
                }
            }

            return $this->redirect("http://front.kali.dev/connexion/0");
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
