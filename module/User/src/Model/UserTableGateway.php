<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 09/06/2017
 * Time: 16:46
 */

namespace Model\User;


class UserTableGateway implements UserTableGatewayInterface
{


    /***
     * @param User $user
     * @return mixed
     */
    public function insertUser(User $user)
    {
        // TODO: Implement insertUser() method.
    }

    /***
     * @param User $user
     * @return mixed
     */
    public function updateUser(User $user)
    {
        // TODO: Implement updateUser() method.
    }

    /***
     * @param User $user
     * @return mixed
     */
    public function deleteUser(User $user)
    {
        // TODO: Implement deleteUser() method.
    }

    /***
     * @param $id int
     * @return User
     */
    public function findUserById($id)
    {
        // TODO: Implement findUserById() method.
    }

    /***
     * @param $username string
     * @return User
     */
    public function findUserByUsername($username)
    {
        // TODO: Implement findUserByUsername() method.
    }
}