<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 22/05/2017
 * Time: 10:32
 */

namespace Album;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Permissions\Acl\Acl;


class Module implements ConfigProviderInterface
{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        // TODO: Implement getConfig() method.
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig(){
        return [
            'factories' => [
                Model\AlbumTable::class => function($container){
                    $tableGateway = $container->get(Model\AlbumTableGateway::class);
                    return new Model\AlbumTable($tableGateway);
                },
                Model\AlbumTableGateway::class => function($container){
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
                    return new TableGateway('album',$dbAdapter,null,$resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig(){
        return [
            'factories' => [
                Controller\AlbumController::class => function($container){
                    return new Controller\AlbumController(
                        $container->get(Model\AlbumTable::class)
                    );
                }
            ]
        ];
    }
}