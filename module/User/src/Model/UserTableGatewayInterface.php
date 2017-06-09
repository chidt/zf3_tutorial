<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 09/06/2017
 * Time: 16:39
 */

namespace Model\User;


interface UserTableGatewayInterface
{
    /***
     * @param User $user
     * @return mixed
     */
    public function insertUser(User $user);

    /***
     * @param User $user
     * @return mixed
     */
    public function updateUser(User $user);

    /***
     * @param User $user
     * @return mixed
     */
    public function deleteUser(User $user);

    /***
     * @param $id int
     * @return User
     */
    public function findUserById($id);

    /***
     * @param $username string
     * @return User
     */
    public function findUserByUsername($username);

}