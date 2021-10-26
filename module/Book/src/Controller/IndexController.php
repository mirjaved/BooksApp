<?php

namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Book\Entity\Book;
use Book\Form\BookForm;

class IndexController extends AbstractActionController
{
    private $entityManager;    

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function indexAction()
    {        
        //$books = $this->entityManager->getRepository(Book::class)->findAll();

        $books = $this->entityManager->getRepository(Book::class)->getAllBooks();

        //echo '<pre>',print_r($books,1),'</pre>';

        print_r($books);

        //return new ViewModel(['books' => $books]);
    }

    public function addAction()
    {
        // Create the form.
        $form = new BookForm;
    
        // Check whether this post is a POST request.
        if ($this->getRequest()->isPost()) {
            
            // Get POST data.
            $data = $this->params()->fromPost();
            
            // Fill form with data.
            $form->setData($data);
            if ($form->isValid()) {
                                
                // Get validated form data.
                $data = $form->getData();

                // Use book manager service to add new book to database.                
                $this->addNewBook($data);
                
                // Redirect the user to "inde x" page.
                return $this->redirect()->toRoute('home');
            }
        }
         
        // Render the view template.
        return new ViewModel(['form' => $form]);
    }

    public function addNewBook($data) 
    {
        // Create new Book entity.
        $book = new Book();
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $book->setAuthor($data['author_id']);
        $book->setCategory($data['category_id']);
        
        // Add the entity to entity manager.
        $this->entityManager->persist($book);
        
        // Apply changes to database.
        $this->entityManager->flush();
    }

    public function editAction()
    {
        // Create form.
        $form = new BookForm();
        
        // Get book ID.
        $bookId = (int)$this->params()->fromRoute('id', -1);
        
        // Validate input parameter
        if ($bookId < 0) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Find the existing book in the database.
        $book = $this->entityManager->getRepository(Book::class)
                ->findOneById($bookId);        
        if ($book == null) {
            $this->getResponse()->setStatusCode(404);
            return;                        
        } 
        
        // Check whether this book is a POST request.
        if ($this->getRequest()->isPost()) {
            
            // Get data.
            $data = $this->params()->fromPost();
            
            // Fill form with data.
            $form->setData($data);
            if ($form->isValid()) {
                                
                // Get validated form data.
                $data = $form->getData();
                
                // Update existing book.
                $this->updateBook($book, $data);
                
                // Redirect the user to "admin" page.
                return $this->redirect()->toRoute('home');
            }
        }
        
        else {
            $data = [
                'title' => $book->getTitle(),
                'description' => $book->getDescription(),
                'author_id' => $book->getAuthor(),
                'category_id' => $book->getCategory(),
            ];
            
            $form->setData($data);
        }
        
        // Render the view template.
        return new ViewModel([
            'form' => $form,
            'book' => $book
        ]);
    }

    /**
     * This method allows to update data of a single book.
     */
    public function updateBook($book, $data) 
    {
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $book->setAuthor($data['author_id']);
        $book->setCategory($data['category_id']);
              
        // Apply changes to database.
        $this->entityManager->flush();
    }

    public function deleteAction()
    {
        $bookId = (int)$this->params()->fromRoute('id', -1);
        
        // Validate input parameter
        if ($bookId<0) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $book = $this->entityManager->getRepository(Book::class)
                ->findOneById($bookId);        
        if ($book == null) {
            $this->getResponse()->setStatusCode(404);
            return;                        
        }
        
        $this->removeBook($book);
        
        // Redirect the user to "admin" page.        
        return $this->redirect()->toRoute('home'); 
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
