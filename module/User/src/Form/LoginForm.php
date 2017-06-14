<?php

/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 13/06/2017
 * Time: 09:18
 */
namespace User\Form;

use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Password;
use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');

        $this->add([
            'name' => 'username',
            'type' => 'text',
            'options' => [
                'label' => 'Username'
            ]
        ]);

        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'options' => [
                'label' => 'Password'
            ]
        ]);

        $this->add([
            'name' => 'remember_me',
            'type' => Checkbox::class,
            'options' => [
                'label' => 'Remember me']
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Sign in'
            ]
        ]);
    }

}