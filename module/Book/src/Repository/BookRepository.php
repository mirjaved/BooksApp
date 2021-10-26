<?php
namespace Book\Repository;
    
use Doctrine\ORM\EntityRepository;
use Book\Entity\Book;
use Book\Entity\Author;

// This is the custom repository class for Book entity.
class BookRepository extends EntityRepository
{
  // Finds all books.
  public function getAllBooks()
  {
    $entityManager = $this->getEntityManager();        
    $queryBuilder = $entityManager->createQueryBuilder();    
    $queryBuilder->select('book')->from(Book::class, 'book')->orderBy('book.id', 'DESC');
    $books = $queryBuilder->getQuery()->getResult();    
    return $books;    
  }

  // Finds all authors.
  public function getAllAuthors()
  {
    $entityManager = $this->getEntityManager();        
    $queryBuilder = $entityManager->createQueryBuilder();    
    $queryBuilder->select('author')->from(Author::class, 'author');
    $authors = $queryBuilder->getQuery()->getResult();    
    return $authors;
  }
}