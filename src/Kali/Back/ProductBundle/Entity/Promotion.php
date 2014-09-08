<?php

namespace Kali\Back\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kali\Back\ProductBundle\Entity\PromotionRepository")
 */
class Promotion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="used", type="boolean")
     */
    private $used;
    
    /*
     * @var Promotion
     * 
     * @ORM\OneToOne(targetEntity="Command", mappedBy="promotion")
     */
    private $promotion;

    function __construct() {
        $this->number = $this->generateNumber();
        $this->used = false;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Promotion
     */
    public function setNumber($number) {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Promotion
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Set used
     *
     * @param boolean $used
     * @return Promotion
     */
    public function setUsed($used) {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return boolean 
     */
    public function getUsed() {
        return $this->used;
    }

    private function generateNumber() {
        $character = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $numero = "";
        for ($i = 0; $i < 15; $i++) {
            $numero .= substr($character, rand() % (strlen($character)), 1);
        }
        return $numero;
    }
    
    public function getPromotion() {
        return $this->promotion;
    }

    public function setPromotion($promotion) {
        $this->promotion = $promotion;
    }

}
