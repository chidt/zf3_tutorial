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
use User\Controller\UserAuthenticationController;
use Zend\Authentication\AuthenticationService;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;

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
    public function onBootstrap(MvcEvent $e)
    {
        $this->initAcl($e);
        $e->getApplication()->getEventManager()->attach(MvcEvent::EVENT_ROUTE, array($this, 'checkAcl'));
    }

    public function initAcl(MvcEvent $e)
    {
        $acl = new Acl();
        $roleGuest = new Role('staff');
        $acl->addRole($roleGuest);
        $acl->addRole(new Role('editor'), 'staff');
        $acl->addRole(new Role('admin'));

        $acl->addResource('album');
        $acl->addResource('blog');
        $acl->addResource('blog/edit');
        $acl->addResource('blog/delete');

        $acl->allow('staff', 'album', 'view');
        $acl->allow('editor', ['album','blog','blog/edit']);
        $acl->allow('admin');

        $e->getViewModel()->setVariable('acl', $acl);
    }

    public function checkAcl(MvcEvent $e)
    {
        //Check login
        $auth = $e->getApplication()
            ->getServiceManager()
            ->get(AuthenticationService::class);
        $controllerName = $e->getRouteMatch()->getParam('controller');
        if (UserAuthenticationController::class != $controllerName && (AlbumController::class === $controllerName
            || ListController::class
            || WriteController::class
            || DeleteController::class)) {
            if ($auth->hasIdentity() === false) {
                $url = $e->getRouter()->assemble(array(), array('name' => 'login'));
                $response = $e->getResponse();
                $response->getHeaders()->addHeaderLine('Location', $url);
                $response->setStatusCode(302);
                $response->sendHeaders();
                return $response;
            } else {
//                $userRole = 'admin';
                $userRole = 'admin';
                $acl = $e->getViewModel()->getVariable('acl');
                $route = $e->getRouteMatch()->getMatchedRouteName();
                if ($acl->hasResource($route) && !$acl->isAllowed($userRole, $route)) {
                    $response = $e->getResponse();
                    //location to page or what ever
                    $response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/404');
                    $response->setStatusCode(404);

                }
            }

        }
    }
}
