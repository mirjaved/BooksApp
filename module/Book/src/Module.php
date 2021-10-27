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
}