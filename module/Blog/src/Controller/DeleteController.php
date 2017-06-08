<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 06/06/2017
 * Time: 12:10
 */

namespace Blog\Controller;

use Blog\Model\Post;
use Blog\Model\PostCommandInterface;
use Blog\Model\PostRepositoryInterface;
use InvalidArgumentException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class DeleteController extends AbstractActionController
{
    /***
     * @var PostCommandInterface
     */
    private $commnad;

    /***
     * @var PostRepositoryInterface
     */
    private $repository;

    /**
     * DeleteController constructor.
     * @param PostCommandInterface $commnad
     * @param PostRepositoryInterface $repository
     */
    public function __construct(PostCommandInterface $commnad, PostRepositoryInterface $repository)
    {
        $this->commnad = $commnad;
        $this->repository = $repository;
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        if(!$id){
            return $this->redirect()->toRoute('blog');
        }

        try{
            $post = $this->repository->findPost($id);
        }catch (\Zend\Db\Exception\InvalidArgumentException $ex){
            return $this->redirect()->toRoute('blog');
        }

        $request = $this->getRequest();
        if(! $request->isPost()){
            return new ViewModel(['post' => $post]);
        }

        if($id != $request->getPost('id') || 'Delete' !== $request->getPost('confirm','no')){
            return $this->redirect()->toRoute('blog');
        }

        $post = $this->commnad->deletePost($post);
        return $this->redirect()->toRoute('blog');
    }

}