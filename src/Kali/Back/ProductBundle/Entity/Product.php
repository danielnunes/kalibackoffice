<?php

namespace Kali\Back\ProductBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ProductRepository")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="lenght", type="integer")
     */
    private $lenght;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="density", type="integer")
     */
    private $density;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;
   

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;
    
    /**
     * @var array
     * 
     * @ORM\ManyToMany(targetEntity="Caracteristic", inversedBy="products")
     * @ORM\JoinTable(name="caracteristic_products")
     */
    private $caracteristics;
    
    /**
     * @var array
     * 
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     * @ORM\JoinTable(name="category_products")
     */
    private $categories;
    
    /**
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Kali\Back\ImageBundle\Entity\Picture", mappedBy="product")
     */
    private $pictures;
    
    /**
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="ProductCommand", mappedBy="product")
     */
    private $productCommands;
    
    
    /**
     * @var Ecotax
     * 
     * @ORM\ManyToOne(targetEntity="Ecotax", inversedBy="products")
     * @ORM\JoinColumn(name="ecotax_id", referencedColumnName="id")
     */
    private $ecotax;
    
    function __construct() {
        $this->caracteristics = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->productCommands = new ArrayCollection();
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
     * @return Product
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
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }
    
    public function getPrice() {
        return $this->price;
    }

    public function getCaracteristics() {
        return $this->caracteristics;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setCaracteristics($caracteristics) {
        $this->caracteristics = $caracteristics;
    }
    
    public function getPictures() {
        return $this->pictures;
    }

    public function setPictures($pictures) {
        $this->pictures = $pictures;
    }
    public function getEcotax() {
        return $this->ecotax;
    }

    public function setEcotax(Ecotax $ecotax) {
        $this->ecotax = $ecotax;
    }
    
    public function getCategories() {
        return $this->categories;
    }

    public function setCategories($categories) {
        $this->categories = $categories;
    }
    public function getProductCommands() {
        return $this->productCommands;
    }

    public function setProductCommands($productCommands) {
        $this->productCommands = $productCommands;
    }
    public function getLenght() {
        return $this->lenght;
    }

    public function getDensity() {
        return $this->density;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setLenght($lenght) {
        $this->lenght = $lenght;
    }

    public function setDensity($density) {
        $this->density = $density;
    }

    public function setWidth($width) {
        $this->width = $width;
    }


}
