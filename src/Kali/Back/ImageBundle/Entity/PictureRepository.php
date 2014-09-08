<?php

namespace Kali\Back\ImageBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Kali\Back\ProductBundle\Entity\Product;

/**
 * PictureRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PictureRepository extends EntityRepository {

    /**
     * 
     * @description Retourne la liste d'image d'un produit
     * @param Product $product
     * @return array(Picture)
     */
    public function galleryProduct(Product $product) {
        return $this->_em->createQuery('SELECT p FROM KaliBackImageBundle:Picture p WHERE p.product=:product ORDER BY p.one DESC')
                        ->setParameter('product', $product)
                        ->getResult();
    }

    /**
     * 
     * @description Retourne l'image à la une d'un produit
     * @param Product $product
     * @return Picture
     */
    public function topPicture(Product $product) {
        return $this->_em->createQuery('SELECT p FROM KaliBackImageBundle:Picture p WHERE p.product=:product AND p.one=1')
        ->setParameter('product', $product)
        ->setMaxResults(1)
        ->getSingleResult();
    }

}