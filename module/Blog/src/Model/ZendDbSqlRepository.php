<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 02/06/2017
 * Time: 14:02
 */

namespace Blog\Model;

use InvalidArgumentException;
use RuntimeException;


use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;

class ZendDbSqlRepository implements PostRepositoryInterface
{
    /***
     * @var AdapterInterface
     */
    private $db;

    /***
     * @var HydratorInterface
     */
    private $hydrator;

    /***
     * @var Post
     */
    private $postPrototype;

    /**
     * ZendDbSqlRepository constructor.
     * @param AdapterInterface $db
     */
    public function __construct(
        AdapterInterface $db,
        HydratorInterface $hydrator,
        Post $postPrototype
    )
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->postPrototype = $postPrototype;
    }


    /***
     * Return a set of all blog posts that we can iterate over.
     *
     * Each entry should be a Post instance.
     *
     * @return Post[
     */
    public function fillAllPosts()
    {
        $sql = new Sql($this->db);
        $select = $sql->select('posts');
        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            return [];
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
        $resultSet->initialize($result);
        return $resultSet;
    }

    /***
     * Return a single blog post.
     *
     * @param int $id Identifier of the post to return.
     * @return Post
     */
    public function findPost($id)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('posts');
        $select->where(['id = ?' => $id]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(sprintf('Failed retrieving blog post with identifier "%s"; unknown database error.', $id));
        }

        $resultSet = new HydratingResultSet($this->hydrator,$this->postPrototype);
        $resultSet->initialize($result);
        $post = $resultSet->current();

        if(!$post){
            throw new InvalidArgumentException(sprintf('Blog post with identifier "%s" not found.',$id));
        }

        return $post;
    }
}