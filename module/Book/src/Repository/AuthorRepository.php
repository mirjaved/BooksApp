<?php
namespace Book\Repository;
    
use Doctrine\ORM\EntityRepository;
use Book\Entity\Author;

// This is the custom repository class for Author entity.
class AuthorRepository extends EntityRepository
{
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