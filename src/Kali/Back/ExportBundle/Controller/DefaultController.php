<?php

namespace Kali\Back\ExportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Kali\Back\ProductBundle\Entity\Product;
use Kali\Back\ProductBundle\Entity\Command;
use Kali\Back\UserBundle\Entity\Client;
use Kali\Back\UserBundle\Entity\User;


class DefaultController extends Controller
{
    /**
     * 
     * @Route("/export-doc", name = "export_doc")
     * @Template()
     */
    public function exportDocAction() {
        return Array();
    }
    
    /**
     * 
     * @Route("/export", name="show_xml")
     * @template()
     */
    public function exportAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        if('POST' === $request->getMethod()) { 
            $submit_client = $request->get("submit_client");
            $submit_product = $request->get("submit_product");
            $submit_command = $request->get("submit_command");
            if(isset ($submit_client) || isset($export_all_client)) {
                $date_debut_client = $request->get("date_debut_client");
                $date_fin_client = $request->get("date_fin_client");
                $export_all_client = $request->get("export_all_client");
    //            if(isset($submit) ) {  
                    if(!isset($date_debut_client) && $date_fin_client == null) {
                        $userClients = $em->createQuery('SELECT c FROM KaliBackUserBundle:Client c WHERE c.createDate > :date')
                                        ->setParameter('date', $date_debut_client)
                                        ->getResult();
                    }
    //            }
                elseif($date_debut_client == null && isset($date_fin_client) && $date_fin_client != null) {
                    $userClients = $em->createQuery('SELECT c FROM KaliBackUserBundle:Client c WHERE c.createDate > :date')
                                    ->setParameter('date', $date_fin_client)
                                    ->getResult();
                }
                elseif(isset($date_debut_client) && $date_debut_client != null && isset($date_fin_client) && $date_fin_client != null) {
                    $userClients = $em->createQuery('SELECT c FROM KaliBackUserBundle:Client c WHERE c.createDate > :date_debut AND c.createDate < :date_fin')
                                    ->setParameters(
                                            array ('date_debut' => $date_debut_client,
                                                    'date_fin' => $date_fin_client))
                                    ->getResult();
                }

                elseif(isset($export_all_client)) {
                    $userClients = $em->getRepository("KaliBackUserBundle:Client")
                                    ->findAll();
                }

//                if($userClients != null) {
                    $xml_client = new \SimpleXMLElement('<xml></xml>');
                    foreach ($userClients as $userClient) {
                        $gender = $xml_client->addChild("gender", $userClient->getGender());
                        $firstName= $xml_client->addChild("firstName", $userClient->getFirstName());
                        $lastName = $xml_client->addChild("lastName", $userClient->getLastName());
                        $address= $xml_client->addChild("address", $userClient->getAddress());
                        $postalCode = $xml_client->addChild("postalCode", $userClient->getPostalCode());
                        $city = $xml_client->addChild("city", $userClient->getCity());
                        $phone= $xml_client->addChild("phone", $userClient->getPhone());
                        $mobilePhone= $xml_client->addChild("mobilePhone", $userClient->getMobilePhone());

                        Header('Content-type: text/xml');
                        header('Content-Disposition: attachment; filename="'.$xml_client.'.xml"');
                        echo($xml_client->asXML());
                        exit();
                    }
//                }
            
        }
        
        if(isset($submit_command) ) {
            $date_debut_command = $request->get('date_debut_command');
            $date_fin_client = $request->get("date_fin_command");
            $export_all_command = $request->get("export_all_command");
            if(isset($date_debut_command)) {
                $commands = $em->createQuery('SELECT c FROM KaliBackProductBundle:Command c WHERE c.date > :date')
                                ->setParameter('date', $date_debut_command)
                                ->getResult();
            }
            elseif(!isset($date_debut_client) && isset($date_fin_client)) {
                $commands = $em->createQuery('SELECT c FROM KaliBackProductBundle:Command c WHERE c.createDate > :date')
                                ->setParameter('date', $date_fin_client)
                                ->getResult();
            }
            elseif(isset($date_debut_client) && isset($date_fin_client)) {
                $commands = $em->createQuery('SELECT c FROM KaliBackProductBundle:Command c WHERE c.createDate > :date_debut AND c.createDate < :date_fin')
                                ->setParameters(
                                        array ('date_debut' => $date_debut_client,
                                                'date_fin' => $date_fin_client))
                                ->getResult();
            }
            elseif(isset($export_all_command)) {
                $commands = $em->getRepository("KaliBackProductBundle:Command")
                                ->findAll();
            }

            $length = count($commands);
            $xml_command = new \SimpleXMLElement('<xml></xml>');
            foreach ($commands as $command) {
                $date = $xml_command->addChild("date");
                $price= $xml_command->addChild("price");
                $price->addChild("title", $command->getPrice());
                $status = $xml_command->addChild("status");
                $status->addChild("title", $command->getStatus());

                Header('Content-type: text/xml');
                header('Content-Disposition: attachment; filename="'.$xml_command.'.xml"');
                echo($xml_command->asXML()) ;
                exit();
            }
        }
        if(isset($submit_product)) {
            $date_debut_produit = $request->get('date_debut_produit');
            $date_fin_client = $request->get("date_fin_produit");
            $export_all_product = $request->get("export_all_product");
            if(isset($date_debut_produit)) {
                $products = $em->createQuery('SELECT c FROM KaliBackProductBundle:Product c ORDER by c.id DESC')
                                ->getResult();
            }
            elseif(!isset($date_debut_client) && isset($date_fin_client)) {
                $products = $em->createQuery('SELECT c FROM KaliBackProductBundle:Product c WHERE c.createDate > :date')
                                ->setParameter('date', $date_fin_client)
                                ->getResult();
            }
            elseif(isset($date_debut_client) && isset($date_fin_client)) {
                $products = $em->createQuery('SELECT c FROM KaliBackProductBundle:Product c WHERE c.createDate > :date_debut AND c.createDate < :date_fin')
                                ->setParameters(
                                        array ('date_debut' => $date_debut_client,
                                                'date_fin' => $date_fin_client))
                                ->getResult();
            }
            elseif(isset($export_all_product)) {
                $products = $em->getRepository("KaliBackProductBundle:Product")
                                ->findAll();
            }

            $length = count($products);
            $product = new Product();
            $xml_product = new \SimpleXMLElement('<xml></xml>');
            foreach ($products as $product) {
                $name = $xml_product->addChild("name");
                $name->addChild("title", $product->getName());
                $description= $xml_product->addChild("description");
                $description->addChild("title", $product->getDescription());
                $price = $xml_product->addChild("price");
                $price->addChild("title", $product->getPrice());
                $stock= $xml_product->addChild("stock", $product->getStock());
                $stock->addChild("title", $product->getStock());

                Header('Content-type: text/xml');
                header('Content-Disposition: attachment; filename="'.$xml_product.'.xml"');
                echo($xml_product->asXML());
                exit();
                }
        }
            }
            
            
        return $this->render("KaliBackExportBundle:Default:exportDoc.html.twig");
        
    }
}
