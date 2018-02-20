<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 05/10/2017
 * Time: 17:44
 */

namespace User\Form;


use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\Form\Element\Password;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');

        $this->add([
            'name' => 'username',
            'type' => Text::class,
            'options' => [
                'label' => 'Email'
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
            'name' => 'remember',
            'type' => Checkbox::class,
            'options' => [
                'label' => 'Remember me'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Login'
            ]
        ]);
    }
}