<?php

namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Book\Form\BookForm;
use Book\Entity\Book;
use Book\Entity\Author;
use Book\Entity\Category;

class BookController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;
    
    /**
     * Book manager.
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
     * This function return all the Authors from database.
     */
    public function selectAuthors()
    {
        $authors = $this->entityManager->getRepository(Author::class)->getAllAuthors();
        foreach($authors as $author)
        {
            $allAuthors[$author->getId()] = $author->getAuthor();
        }
        return $allAuthors;
    }

    /**
     * This function return all the Categories from database.
     */
    public function selectCategories()
    {
        $categories = $this->entityManager->getRepository(Category::class)->getAllCategories();
        foreach($categories as $category)
        {
            $allCategories[$category->getId()] = $category->getCategory();
        }
        return $allCategories;
    }   

    /**
     * This action displays the "New Book" page. The page contains a form allowing
     * to enter several fields. When the user clicks the Submit button,
     * a new Book entity will be created.
     */
    public function addAction()
    {
        $allAuthors    = $this->selectAuthors();
        $allCategories = $this->selectCategories();

        // Create the form.
        $form = new BookForm($allAuthors, $allCategories);
    
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
        $allAuthors    = $this->selectAuthors();
        $allCategories = $this->selectCategories();

        // Create form.
        $form = new BookForm($allAuthors, $allCategories);
        
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

        $request = $this->getRequest();
        if (!$request->isPost()) {            
            return new ViewModel([
                'id' => $bookId,
                'book' => $book,
            ]);
        }

        $delete = $request->getPost('delete', 'No');
        if($delete == 'Yes') {            
            $this->bookManager->removeBook($book);
            return $this->redirect()->toRoute('home');
        } else {
            return $this->redirect()->toRoute('home');    
        }
    }
}