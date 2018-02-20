<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 08/12/2017
 * Time: 11:20
 */

namespace User\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Authentication\AuthenticationService;
use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter as DbAuthAdapter;

class AuthenticationServiceFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        $credentialValidationCallback = function ($dbCredential,$requestCredential){
            return (new Bcrypt())->verify($requestCredential,$dbCredential);
        };
        $authAdapter = new DbAuthAdapter($dbAdapter,'users','username','password',$credentialValidationCallback);
        $authService = new AuthenticationService();
        $authService->setAdapter($authAdapter);
        return $authService;
    }
}