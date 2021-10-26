<?php
namespace Book\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a single book in a Book.
 * @ORM\Entity(repositoryClass="\Book\Repository\BookRepository")
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="category")
     */
    protected $category;
    
    /**
     * Returns ID of this category.
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets ID of this category.
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }   

    /**
     * Returns category.
     * @return string
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Sets category.
     * @param string $category
     */
    public function seCategory($category) {
        $this->category = $category;
    }
    
}

