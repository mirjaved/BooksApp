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
        $data = $this->entityManager->getRepository(Author::class)->getAllAuthors();

        $form = new MyForm();

        $form->setAuthors($data);

        return $form;
}
}