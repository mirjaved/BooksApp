<?php

namespace Book\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Book\Entity\Book;

/**
 * The BookManager service is responsible for adding new books, updating existing
 * books etc.
 */
class BookManager
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager;
     */
    private $entityManager;
    
    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * This method adds a new book.
     */
    public function addNewBook($data) 
    {
        // Create new book entity.
        $book = new Book();
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $book->setAuthorId($data['author_id']);
        $book->setCategoryId($data['category_id']);
        
        // Add the entity to entity manager.
        $this->entityManager->persist($book);
     
        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * This method allows to update data of a single book.
     */
    public function updateBook($book, $data) 
    {
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $book->setAuthorId($data['author_id']);
        $book->setCategoryId($data['category_id']);
              
        // Apply changes to database.
        $this->entityManager->flush();
    }
    
    /**
     * Removes book.
     */
    public function removeBook($book) 
    { 
        $this->entityManager->remove($book);        
        $this->entityManager->flush();
    }    
}