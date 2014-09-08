<?php

namespace Kali\Back\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/picture")
 */
class PictureController extends Controller {

    /**
     * @Route("/delete/{id}", name="picture_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $picture = $this->getDoctrine()
                ->getRepository("KaliBackImageBundle:Picture")
                ->find($id);
        $product = $picture->getProduct();
        $path = $picture->getPath();
        $one = $picture->getOne();
        $em->remove($picture);
        $em->flush();

        if ($one) {
            $pictures = $this->getDoctrine()
                    ->getRepository("KaliBackImageBundle:Picture")
                    ->galleryProduct($product);
            if (!empty($pictures)) {
                foreach ($pictures as $img) {
                    $img->setOne(1);
                    $em->flush();
                    break;
                }
            }
        }
        if(file_exists ($path )){
            unlink ( $path );
        }
        return $this->redirect($this->generateUrl("product_gallery", array("id" => $product->getId())));
    }

    /**
     * @Route("/top/{id}", name="picture_top")
     * @Template()
     */
    public function topAction($id) {
        $em = $this->getDoctrine()->getManager();
        $picture = $this->getDoctrine()
                ->getRepository("KaliBackImageBundle:Picture")
                ->find($id);

        $top = $this->getDoctrine()
                ->getRepository("KaliBackImageBundle:Picture")
                ->topPicture($picture->getProduct());
        
        $picture->setOne(1);
        $top->setOne(0);
        
        $em->flush();
        
        return $this->redirect($this->generateUrl("product_gallery", array("id" => $picture->getProduct()->getId())));
    }

}
