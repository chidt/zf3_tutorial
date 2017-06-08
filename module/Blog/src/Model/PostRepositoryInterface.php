<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 01/06/2017
 * Time: 15:25
 */

namespace Blog\Model;


interface PostRepositoryInterface
{
    /***
     * Return a set of all blog posts that we can iterate over.
     *
     * Each entry should be a Post instance.
     *
     * @return Post[
     */
    public function fillAllPosts();

    /***
     * Return a single blog post.
     *
     * @param int $id Identifier of the post to return.
     * @return Post
     */
    public function findPost($id);
}