<?php

namespace Kali\Rest\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SenderController extends Controller
{
    public function getSenderWeightAction($size, $weight)
    {
        $sender = $this->getDoctrine()
            ->getRepository("KaliBackProductBundle:Sender")
            ->findSenderByWeightAndSize($size, $weight);
        return $sender;
    }
}