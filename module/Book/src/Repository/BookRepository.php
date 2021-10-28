<?php
namespace Book\Repository;
    
use Doctrine\ORM\EntityRepository;
use Book\Entity\Book;
use Book\Entity\Author;

// use Book\Entity\Category;

// This is the custom repository class for Book entity.
class BookRepository extends EntityRepository
{
  // Finds all books.
  public function getAllBooks()
  {
    $entityManager = $this->getEntityManager();
    $queryBuilder = $entityManager->createQueryBuilder();
    
    $queryBuilder->select('book')
                ->from(Book::class, 'book')
                ->leftjoin('book.authors', 'author')                
                //->where('book.id = author.id')
                ->orderBy('book.id', 'DESC');

    $books = $queryBuilder->getQuery()->getResult();
    return $books;
  }
}