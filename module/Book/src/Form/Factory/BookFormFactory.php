<?php

namespace Book\Form\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Book\Service\BookManager;

use Book\Entity\Author;

/**
 * This is the factory for BookForm. Its purpose is to instantiate it.
 */
class BookFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $repository = $container->get(Author::class);
        
        // Instantiate the controller and inject dependencies
        return new BookFormFactory($entityManager, $bookManager);
    }
}