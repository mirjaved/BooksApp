<?php

namespace Book\Repository;

use Doctrine\ORM\EntityRepository;
use Book\Entity\Book;

/**
 * This is the custom repository class for Book entity.
 */
class BookRepository extends EntityRepository
{
    /**
     * Retrieves all the books in descending date order.
     * @return Query
     */
    public function getAllBooks()
    {
        $entityManager = $this->getEntityManager();        
        $queryBuilder = $entityManager->createQueryBuilder();
        
        $queryBuilder->select('title')->from(Book::class, 'title');
 
        return $queryBuilder->getQuery();
    }
}