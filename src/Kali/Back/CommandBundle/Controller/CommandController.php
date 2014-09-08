<?php

namespace Kali\Back\CommandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommandController extends Controller
{
    /**
     * @Route("/list")
     * @Template()
     */
    public function listAction()
    {
        
    }

    /**
     * @Route("/plug/{id}")
     * @Template()
     */
    public function plugAction($id)
    {
        return array(
                // ...
            );    }

}
