<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Album\Controller\AlbumController;
use Album\Model\Album;
use Blog\Controller\DeleteController;
use Blog\Controller\ListController;
use Blog\Controller\WriteController;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /***
     * @param MvcEvent $event
     * This method is called once the MVC bootstrapping is complete and allows
     * to register event listeners
     */
//    public function onBootstrap(MvcEvent $event)
//    {
//
//        $eventManager = $event->getApplication()->getEventManager();
//        $eventManager->attach(MvcEvent::EVENT_ROUTE, function ($e) {
//            $controllerName = $e->getRouteMatch()->getParam('controller', null);
//            if (AlbumController::class === $controllerName || DeleteController::class == $controllerName || ListController::class || WriteController::class) {
//                $auth = $e->getApplication()
//                    ->getServiceManager()
//                    ->get(AuthenticationService::class);
//                if (false === $auth->hasIdentity()) {
//                    $url = $e->getRouter()->assemble(array(), array('name' => 'login'));
//
//                    $response = $e->getResponse();
//                    $response->getHeaders()->addHeaderLine('Location', $url);
//                    $response->setStatusCode(302);
//                    $response->sendHeaders();
//                    return $response;
//                }
//
//            }
//
//        }, -100);
//    }
}
