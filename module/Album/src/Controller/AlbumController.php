<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 22/05/2017
 * Time: 13:47
 */

namespace Album\Controller;

use Album\Form\AlbumConfirmForm;
use Album\Form\AlbumForm;
use Album\Model\AlbumTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;

class AlbumController extends AbstractActionController
{

    private $table;

    public function __construct(AlbumTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        // Grab the paginator from the Albumtable:
        $paginator = $this->table->fetchAll(true);

        // Set the current page to what has been passed in query string
        // or to 1 if none is set, or the page is invalid:
        $page = (int)$this->params()->fromQuery('page', 1);
        $page = ($page < 1) ? 1 : $page;
        $paginator->setCurrentPageNumber($page);

        // Set the number of items per page to 10:
        $paginator->setItemCountPerPage(10);
        return new ViewModel(['paginator' => $paginator]);
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Confirm');
        $view = new ViewModel(['form' => $form]);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $formConfrim = new AlbumForm('',true);
                $formConfrim->bind($album);
                $view = new ViewModel(['form' => $formConfrim]);
                return $view;
            } else {
                return $view;
            }

        } else {
            return $view;
        }
    }

    public function confirmAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $confirmForm = new AlbumForm();
            $album = new Album();
            $confirmForm->setInputFilter($album->getInputFilter());
            $confirmForm->setData($request->getPost());
            if ($confirmForm->isValid()) {
                return $this->redirect()->toRoute('album');
            }
            $album->exchangeArray($confirmForm->getData());
            $this->table->saveAlbum($album);
        }
        return $this->redirect()->toRoute('album');
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        try {
            $album = $this->table->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($album->getInputFIlter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return $viewData;
        }

        $this->table->saveAlbum($album);

        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int)$request->getPost('id');
                $this->table->deleteAlbum($id);
            }

            return $this->redirect()->toRoute('album');
        }

        return [
            'id' => $id,
            'album' => $this->table->getAlbum($id)
        ];
    }
}