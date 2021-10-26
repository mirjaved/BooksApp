<?php

namespace Book\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a single book in a Book.
 * @ORM\Entity(repositoryClass="\Book\Repository\BookRepository")
 * @ORM\Table(name="book")
 */
class Book 
{
     /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="title")  
     */
    protected $title;

     /** 
     * @ORM\Column(name="description")  
     */
    protected $description;

    /** 
     * @ORM\Column(name="author_id")  
     */
    protected $author_id;

    /**
     * @ORM\Column(name="category_id")  
     */
    protected $category_id;


    /**
     * Returns ID of this book.
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets ID of this book.
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Returns title.
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Sets title.
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Returns description.
     * @return integer
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets description.
     * @param integer $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Returns book author.
     */
    public function getAuthor() {
        return $this->author_id;
    }

    /**
     * Sets book author.
     * @param type $author_id
     */
    public function setAuthor($author_id) {
        $this->author_id = $author_id;
    }

    /**
     * Returns book category.
     */
    public function getCategory() {
        return $this->category_id;
    }

    /**
     * Sets book category.
     * @param type $category_id
     */
    public function setCategory($category_id) {
        $this->category_id = $category_id;
    }
}

