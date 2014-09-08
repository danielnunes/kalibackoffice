<?php

namespace Kali\Rest\UserBundle\Controller;

use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{
    public function getUserAction($id)
    {
        /* @var $userManager UserManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        return $user;
    }
}
