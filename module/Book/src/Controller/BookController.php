<?php

namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Book\Entity\Book;
use Book\Form\BookForm;

use Book\Entity\Author;

use Zend\Form\FormElementManager;

class BookController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;
    
    /**
     * Post manager.
     * @var Book\Service\BookManager 
     */
    private $bookManager;

    /**
     * Constructor is used for injecting dependencies into the controller.
     */
    public function __construct($entityManager, $bookManager) 
    {
        $this->entityManager = $entityManager;
        $this->bookManager = $bookManager;
    }
    
    public function indexAction()
    {
        $books = $this->entityManager->getRepository(Book::class)->getAllBooks();        
        return new ViewModel(['books' => $books]);
    }

    /**
     * This action displays the "New Book" page. The page contains a form allowing
     * to enter several fields. When the user clicks the Submit button,
     * a new Book entity will be created.
     */
    public function addAction()
    {
        $allAuthors = $this->entityManager->getRepository(Author::class)->getAllAuthors();

        // Create the form.
        $form = new BookForm($allAuthors);
    
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
                $this->bookManager->addNewBook($data);
                
                // Redirect the user to "inde x" page.
                return $this->redirect()->toRoute('home');
            }
        }
         
        // Render the view template.
        return new ViewModel(['form' => $form]);
    }

    
    /**
     * This action displays the page allowing to edit a book.
     */
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
                $this->bookManager->updateBook($book, $data);
                
                // Redirect the user to "admin" page.
                return $this->redirect()->toRoute('home');
            }
        } else {
            $data = [
                'title' => $book->getTitle(),
                'description' => $book->getDescription(),
                'author_id' => $book->getAuthorId(),
                'category_id' => $book->getCategoryId(),
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
     * This will delete book from database.
     */
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
        
        $this->bookManager->removeBook($book);
        
        // Redirect the user to "admin" page.
        return $this->redirect()->toRoute('home'); 
    }
}
