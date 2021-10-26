<?php

namespace Book;

// use Zend\Db\Adapter\AdapterInterface;
// use Zend\Db\TableGateway\TableGateway;
// use Zend\Db\ResultSet\ResultSet;
// use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module
{
    const VERSION = '3.1.4dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    // public function getServiceConfig()
    // {
    //     return [
    //         'factories' => [
    //             Model\BookTable::class =>  function($container) {
    //                 $tableGateway = $container->get(Model\BookTableGateway::class);
    //                 return new Model\BookTable($tableGateway);       
    //             },
    //             Model\BookTableGateway::class => function($container) {
    //                 $dbAdapter = $container->get(AdapterInterface::class);
    //                 $resultSetPrototype = new ResultSet();
    //                 $resultSetPrototype->setArrayObjectPrototype(new Model\Book);
    //                 return new tableGateway('book', $dbAdapter, null, $resultSetPrototype);
    //             },              
    //         ],
    //     ];
    // }   
}