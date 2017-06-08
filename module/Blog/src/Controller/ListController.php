<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 01/06/2017
 * Time: 15:02
 */

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Model\PostRepositoryInterface;
use Zend\View\Model\ViewModel;
use InvalidArgumentException;

class ListController extends AbstractActionController
{
    /***
     * @var PostReposotoryInterface;
     */
    private $postRepository;

    /**
     * ListController constructor.
     * @param PostReposotoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function indexAction()
    {
        return new ViewModel([
            'posts' => $this->postRepository->fillAllPosts(),
        ]);
    }

    public function detailAction(){
        $id = $this->params()->fromRoute('id');

        try{
            $post = $this->postRepository->findPost($id);
        }catch (\InvalidArgumentException $ex){
            return $this->redirect()->toRoute('blog');
        }
        return new ViewModel([
            'post' => $post
        ]);

    }


}