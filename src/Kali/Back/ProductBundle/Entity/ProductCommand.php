<?php

namespace Kali\Back\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductCommand
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kali\Back\ProductBundle\Entity\ProductCommandRepository")
 */
class ProductCommand
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
     * @var integer
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @var Product
     * 
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productCommands")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $product;
      
    /**
     * @var Command
     * 
     * @ORM\ManyToOne(targetEntity="Command", inversedBy="productCommands")
     * @ORM\JoinColumn(name="command_id", referencedColumnName="id")
     */
    private $command;


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
     * Set number
     *
     * @param integer $number
     * @return ProductCommand
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return ProductCommand
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    public function getProduct() {
        return $this->product;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }
    
    public function getCommand() {
        return $this->command;
    }

    public function setCommand(Command $command) {
        $this->command = $command;
    }

}
