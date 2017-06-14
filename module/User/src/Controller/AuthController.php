<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 12/06/2017
 * Time: 13:52
 */

namespace User\Controller;


use User\Form\LoginForm;
use User\Form\LoginFromFilter;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    /***
     * Auth service.
     * @var AuthenticationService
     */
    private $authService;

    /**
     * AuthController constructor.
     * @param AuthenticationService $authService
     */
    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function loginAction()
    {

        $request = $this->getRequest();
        $form = new LoginForm();
        $isLoginError = false;
        if ($request->isPost()) {
            // Fill in the form with POST data
            $data = $request->getPost();
            $formFilter = new LoginFromFilter();
            $form->setInputFilter($formFilter->getInputFilter());
            $form->setData($data);
            // Validate form
            if (!$form->isValid()) {
                return new ViewModel(['form' => $form, 'isLoginError' => true]);
            }
                // Get filtered and validated data
                $data = $form->getData();
                //Authentication
                if ($this->authService->getIdentity() != null) {
                    throw new \Exception('Already logged in');
                }

                $authAdapter = $this->authService->getAdapter();

//                $authAdapter->setUsername($data);


        } else {
            return new ViewModel(['form' => $form, 'isLoginError' => false]);
        }
    }

}