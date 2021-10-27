<?php

namespace Book\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Book\Entity\Author;
use Book\Entity\Category;

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
     * @ORM\OneToMany(targetEntity="\Book\Entity\Author", mappedBy="book")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $authors;

    /**
   * @ORM\OneToMany(targetEntity="\Book\Entity\Category", mappedBy="book")
   * @ORM\JoinColumn(name="id", referencedColumnName="id")
   */
    protected $categories;

    /**
     * Constructor.
     */
    public function __construct() 
    {
        $this->authors = new ArrayCollection();        
        $this->categories = new ArrayCollection();        
    }


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
    public function getAuthorID() {
        return $this->author_id;
    }

    /**
     * Sets book author.
     * @param type $author_id
     */
    public function setAuthorID($author_id) {
        $this->author_id = $author_id;
    }

    /**
     * Returns book category.
     */
    public function getCategoryId() {
        return $this->category_id;
    }

    /**
     * Sets book category.
     * @param type $category_id
     */
    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }


    /**
     * Returns comments for this post.
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Adds a new comment to this post.
     * @param $comment
     */
    public function addAuthors($authors) 
    {
        $this->authors = $authors;
    }

    /**
     * Returns categories.
     * @return array
     */
    public function getCategories() 
    {
        return $this->categories;
    }

    /**
     * Adds categories to this book.
     * @param $categories
     */
    public function addCategories($categories) 
    {
        $this->categories[] = $categories;
    }
}

