<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 05/06/2017
 * Time: 10:19
 */

namespace Blog\Model;


class PostCommand implements PostCommandInterface
{

    /***
     * Persist a new post in the system.
     *
     * @param Post $post The post to insert; may or my not have an identifier
     * @return Post The inserted post, with identifier.
     */
    public function insertPost(Post $post)
    {
        // TODO: Implement insertPost() method.
    }

    /***
     * Update an existing post in the system.
     *
     * @param Post $post Teh post to update, must have an identifier
     * @return Post The updated post.
     */
    public function updatePost(Post $post)
    {
        // TODO: Implement updatePost() method.
    }

    /***
     * Delete a post from the system.
     *
     * @param Post $post The post to delelete
     * @return bool
     */
    public function deletePost(Post $post)
    {
        // TODO: Implement deletePost() method.
    }
}