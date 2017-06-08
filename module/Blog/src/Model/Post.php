<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 01/06/2017
 * Time: 15:45
 */

namespace Blog\Model;


class Post
{
    /***
     * @var int
     */
    private $id;

    /***
     * @var string
     */
    private $text;

    /***
     * @var string
     */
    private $title;

    /**
     * Post constructor.
     * @param int $id
     * @param string $text
     * @param string $title
     */
    public function __construct($title, $text, $id = null )
    {
        $this->id = $id;
        $this->text = $text;
        $this->title = $title;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }




}