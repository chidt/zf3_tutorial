<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 23/05/2017
 * Time: 10:39
 */

namespace Album\Form;

use Zend\Form\Form;


class AlbumForm extends Form
{
    private $confirmed = false;

    public function __construct($name = null,$confirm = false)
    {
        parent::__construct('album');
        $this->confirmed = $confirm;
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'title',
            'type' => $this->confirmed ? 'hidden' : 'text',
            'options' => [
                'label' => 'Title'
            ],
        ]);

        $this->add([
            'name' => 'artist',
            'type' => $this->confirmed ? 'hidden' : 'text',
            'options' => [
                'label' => 'Artist'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id' => 'submitbutton'
            ]
        ]);
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

}