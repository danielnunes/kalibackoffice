<?php

namespace Kali\Back\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slider
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kali\Back\ImageBundle\Entity\SliderRepository")
 */
class Slider {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 
     * @var Picture
     * 
     * @ORM\OneToOne(targetEntity="Picture", inversedBy="slider")
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id")
     */
    private $picture;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    
    public function getPicture() {
        return $this->picture;
    }

    public function setPicture(Picture $picture) {
        $this->picture = $picture;
    }



}
