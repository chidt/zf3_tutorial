<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 09/06/2017
 * Time: 15:28
 */

namespace User\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Model\User\User;
use Model\User\UserTableGatewayInterface;


class AuthAdapter implements AdapterInterface
{
    /***
     * User username
     * @var string
     */
    private $username;

    /***
     * User password
     * @var string
     */
    private $password;

    /***
     * Entity manager
     * @var UserTableGatewayInterface
     */
    private $userTableGateway;

    /**
     * AuthAdapter constructor.
     * @param UserTableGateway $userTableGateway
     */
    public function __construct(UserTableGatewayInterface $userTableGateway)
    {
        $this->userTableGateway = $userTableGateway;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = (string)$password;
    }


    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $user = $this->userTableGateway->findUserByUsername($this->username);

        if ($user == null) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid credentials.']
            );
        }

        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();

        if($bcrypt->verify($this->password,$passwordHash)){
            return new Result(
                Result::SUCCESS,
                $this->username,
                ['Authenticated successfully']
            );
        }

        return new Result(
            Result::FAILURE_CREDENTIAL_INVALID,
            null,
            ['Invalid credentials']
        );
    }
}