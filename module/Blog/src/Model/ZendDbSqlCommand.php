<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 05/06/2017
 * Time: 11:32
 */

namespace Blog\Model;

use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;


class ZendDbSqlCommand implements PostCommandInterface
{

    /***
     * @var AdapterInterface;
     */
    private $db;

    /**
     * ZendDbSqlCommand constructor.
     * @param AdapterInterface $db
     */
    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }


    /***
     * Persist a new post in the system.
     *
     * @param Post $post The post to insert; may or my not have an identifier
     * @return Post The inserted post, with identifier.
     */
    public function insertPost(Post $post)
    {
        $insert = new Insert('posts');
        $insert->values([
            'title' => $post->getTitle(),
            'text' => $post->getText(),
        ]);

        $sql = new Sql($this->db);
        $statment = $sql->prepareStatementForSqlObject($insert);
        $result = $statment->execute();

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during blog post insert operation'
            );
        }

        $id = $result->getGeneratedValue();

        return new Post(
            $post->getTitle(),
            $post->getText(),
            $result->getGeneratedValue()
        );
    }

    /***
     * Update an existing post in the system.
     *
     * @param Post $post Teh post to update, must have an identifier
     * @return Post The updated post.
     */
    public function updatePost(Post $post)
    {
        if (!$post->getId()) {
            throw new RuntimeException('Cannot update post; missing identifier');
        }

        $update = new Update('posts');
        $update->set([
            'title' => $post->getTitle(),
            'text' => $post->getText()
        ]);

        $update->where(['id = ?' => $post->getId()]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during blog post update operation '
            );
        }

        return $post;
    }

    /***
     * Delete a post from the system.
     *
     * @param Post $post The post to delelete
     * @return bool
     */
    public function deletePost(Post $post)
    {
        if (!$post->getId()) {
            throw new RuntimeException('Cannot update post; missing identifier');
        }

        $delete = new Delete('posts');
        $delete->where(['íd = ?' => $post->getId()]);

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($delete);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            return false;
        }

        return true;

    }
}