<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 09/06/2017
 * Time: 15:54
 */

namespace Model\User;


class User
{
    private $id;

    private $username;

    private $password;

    private $real_name;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $password
     * @param $real_name
     */
    public function __construct($id, $username, $password, $real_name)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->real_name = $real_name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRealName()
    {
        return $this->real_name;
    }

    /**
     * @param mixed $real_name
     */
    public function setRealName($real_name)
    {
        $this->real_name = $real_name;
    }




}