<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 01/06/2017
 * Time: 15:25
 */

namespace Blog\Model;


interface PostCommandInterface
{
    /***
     * Persist a new post in the system.
     *
     * @param Post $post The post to insert; may or my not have an identifier
     * @return Post The inserted post, with identifier.
     */
    public function insertPost(Post $post);

    /***
     * Update an existing post in the system.
     *
     * @param Post $post Teh post to update, must have an identifier
     * @return Post The updated post.
     */
    public function updatePost(Post $post);

    /***
     * Delete a post from the system.
     *
     * @param Post $post The post to delelete
     * @return bool
     */
    public function deletePost(Post $post);
}