<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use User\Form\LoginForm;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserAuthenticationController extends AbstractActionController
{

    /**
     * @var AuthenticationService
     */
    private $auth;

    /**
     * UserAuthentication constructor.
     * @param AuthenticationService $auth
     */
    public function __construct($auth)
    {
        $this->auth = $auth;
    }


    public function loginAction()
    {
        $form = new LoginForm();
        $view = new ViewModel(['form' => $form]);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $username = $request->getPost('username');
            $passowrd = $request->getPost('password');
            $remember = $request->getPost('remember');
            $this->auth->getAdapter()->setIdentity($username)->setCredential($passowrd);
            $result = $this->auth->authenticate();
            if ($result->getCode() == 1) {
                $columnsToOmit = ['password'];
                $resultRowObject = $this->auth->getAdapter()->getResultRowObject(null, $columnsToOmit);
                $this->auth->getStorage()->write($resultRowObject);
                if($remember){
                    $this->sessionManager->rememberMe(60*60*24*30);
                }
                return $this->redirect()->toRoute('home');
            } else {
                return new ViewModel(['form' => $form, 'isLoginError' => true]);
            }

        }
        return $view;
    }

    public function logoutAction()
    {
        if (!$this->auth->getIdentity() == null) {
            $this->auth->clearIdentity();
        }
        return $this->redirect()->toRoute('login');
    }


}
