<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 05/06/2017
 * Time: 08:58
 */

namespace Blog\Form;

use Zend\Form\Form;

class PostForm extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'post',
            'type' => PostFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true,
            ]
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Insert new Post',
            ],
        ]);
    }
}