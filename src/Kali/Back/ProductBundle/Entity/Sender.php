<?php

namespace Kali\Back\ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sender
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SenderRepository")
 */
class Sender
{
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxSize", type="integer")
     */
    private $maxSize;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxWeight", type="integer")
     */
    private $maxWeight;
    
    /**
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Command", mappedBy="sender")
     */
    private $commands;
    
    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    
    function __construct() {
        $this->commands = new ArrayCollection();
    }

    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Sender
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set maxSize
     *
     * @param integer $maxSize
     * @return Sender
     */
    public function setMaxSize($maxSize)
    {
        $this->maxSize = $maxSize;

        return $this;
    }

    /**
     * Get maxSize
     *
     * @return integer 
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * Set maxWeight
     *
     * @param integer $maxWeight
     * @return Sender
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;

        return $this;
    }

    /**
     * Get maxWeight
     *
     * @return integer 
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }
    
    public function getCommands() {
        return $this->commands;
    }

    public function setCommands($commands) {
        $this->commands = $commands;
    }
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}
