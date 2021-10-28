<?php
namespace Book\Repository;
    
use Doctrine\ORM\EntityRepository;
use Book\Entity\Category;

// This is the custom repository class for Author entity.
class CategoryRepository extends EntityRepository
{
  // Finds all authors.
  public function getAllCategories()
  {
    $entityManager = $this->getEntityManager();
    $queryBuilder = $entityManager->createQueryBuilder();

    $queryBuilder->select('author')->from(Category::class, 'author');
    $categories = $queryBuilder->getQuery()->getResult();
    
    return $categories;
  }
}