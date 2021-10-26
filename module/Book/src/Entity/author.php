<?php
namespace Book\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a single book in a Book.
 * @ORM\Entity(repositoryClass="\Book\Repository\BookRepository")
 * @ORM\Table(name="author")
 */
class Author
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="author")
     */
    protected $author;    
        
    /**
     * Returns ID of this author.
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets ID of this author.
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }   

    /**
     * Returns author.
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Sets author.
     * @param string $author
     */
    public function setAuthor($author) {
        $this->author_id = $author;
    }
    
}

