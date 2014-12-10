<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppCommon\CommonLayoutBundle\FlashMessenger\MessageFactory;
use App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\Note;

class NoteController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * 
     * @param Request $request
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $slug)
    {
        $modelNotebook = $this->getModelNotebook();
        $userId = $this->getUser()->getId();
        
        $notebook = $modelNotebook->getBySlugAndUser($slug, $userId);
        
        if(! $this->get('security.context')->isGranted('notebook.view', $notebook)) {
            throw $this->createAccessDeniedException();
        }
        if(! $this->get('security.context')->isGranted('note.list')) {
            throw $this->createAccessDeniedException();
        }
        
        $view = [];
        
        $params = [];
        $paramsListing = $params + [
            'returnQuery' => true,
            'notebook' => $notebook->getId(),
        ];
        
        $model = $this->getModelNote();
        
        $page = (int) $request->query->get('page', 1);
        $pageLimit = 10;
        
        /* @var $paginator \Knp\Component\Pager\PaginatorInterface */
        $paginator = $this->container->get('knp_paginator');
        /* @var $pagination \Knp\Component\Pager\Pagination\AbstractPagination */
        $pagination = $paginator->paginate($model->getList($paramsListing), $page, $pageLimit);
        
        $view['itemsPagination'] = $pagination;
        $view['items'] = $pagination->getItems();
        $view['notebook'] = $notebook;
        
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Note:index.html.twig', $view);
    }
    
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @param string $notebookSlug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, $notebookSlug)
    {
        $modelNotebook = $this->getModelNotebook();
        $userId = $this->getUser()->getId();
        
        $notebook = $modelNotebook->getBySlugAndUser($notebookSlug, $userId);
        
        if(! $this->get('security.context')->isGranted('notebook.view', $notebook)) {
            throw $this->createAccessDeniedException();
        }
        if(! $this->get('security.context')->isGranted('note.create')) {
            throw $this->createAccessDeniedException();
        }
    
        $view = [];

        $model = $this->getModelNote();
        
        $entity = new Note();
        
        $form = $this->createForm('note', $entity);
        $form->handleRequest($request);
        
        if($form->isValid()) {
            $entity->setNotebook($notebook);
            
            $model->save($entity);
            
            $this->get('session')->getFlashBag()->add(
                'notice',
                MessageFactory::createMessage('The note has been added successfully.')
            );
            
            return $this->redirect($this->generateUrl('app_module_notebook.ui.notebook.view', [
                'slug' => $entity->getNotebook()->getSlug(),
            ]));
        }
        
        $view['item'] = $entity;
        $view['form'] = $form->createView();
        
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Note:create.html.twig', $view);
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @param string $notebookSlug
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, $notebookSlug, $id)
    {
        $modelNotebook = $this->getModelNotebook();
        $userId = $this->getUser()->getId();
        
        $notebook = $modelNotebook->getBySlugAndUser($notebookSlug, $userId);
        
        if(! $this->get('security.context')->isGranted('notebook.view', $notebook)) {
            throw $this->createAccessDeniedException();
        }
    
        $model = $this->getModelNote();
    
        $entity = $model->findOneById($id);
    
        if(null === $entity) {
            throw $this->createNotFoundException();
        }
    
        if(! $this->get('security.context')->isGranted('note.view', $entity)) {
            throw $this->createAccessDeniedException();
        }
        
        $view = [];
        
        $view['item'] = $entity;
        
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Note:view.html.twig', $view);
    }
    
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @param string $notebookSlug
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $notebookSlug, $id)
    {
        $modelNotebook = $this->getModelNotebook();
        $userId = $this->getUser()->getId();
        
        $notebook = $modelNotebook->getBySlugAndUser($notebookSlug, $userId);
        
        if(! $this->get('security.context')->isGranted('notebook.view', $notebook)) {
            throw $this->createAccessDeniedException();
        }
        
        $model = $this->getModelNote();
        
        $entity = $model->findOneById($id);
        
        if(null === $entity) {
            throw $this->createNotFoundException();
        }
        
        if(! $this->get('security.context')->isGranted('note.update', $entity)) {
            throw $this->createAccessDeniedException();
        }

        $view = [];
        
        $form = $this->createForm('note', $entity);
        $form->handleRequest($request);
    
        if($form->isValid()) {
    
            $entity->setOwner($this->getUser());
    
            $model->save($entity);
    
            $this->get('session')->getFlashBag()->add(
                'notice',
                MessageFactory::createMessage('The note has been updated successfully.')
            );
    
            return $this->redirect($this->generateUrl('app_module_notebook.ui.notebook.view', [
                'slug' => $entity->getNotebook()->getSlug(),
            ]));
        }
        
        $view['item'] = $entity;
        $view['form'] = $form->createView();
    
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Note:update.html.twig', $view);
    }
    
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @param string $notebookSlug
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request, $notebookSlug, $id)
    {
        $modelNotebook = $this->getModelNotebook();
        $userId = $this->getUser()->getId();
        
        $notebook = $modelNotebook->getBySlugAndUser($notebookSlug, $userId);
        
        if(! $this->get('security.context')->isGranted('notebook.view', $notebook)) {
            throw $this->createAccessDeniedException();
        }
        
        $model = $this->getModelNote();
        
        $entity = $model->findOneById($id);
        
        if(null === $entity) {
            throw $this->createNotFoundException();
        }
        
        if(! $this->get('security.context')->isGranted('note.delete', $entity)) {
            throw $this->createAccessDeniedException();
        }
        
        $view = [];
        
        $form = $this->createForm('commonDeleteConfirmation');
        $form->handleRequest($request);
        
        if($form->isValid()) {
            if($form->get('confirm')->isClicked()) {
                $model->remove($entity);
                
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    MessageFactory::createMessage('The notebook has been deleted successfully.')
                );
                
                return $this->redirect($this->generateUrl('app_module_notebook.ui.notebook.view', [
                    'slug' => $entity->getNotebook()->getSlug(),
                ]));
            }
        }
        
        $view['item'] = $entity;
        $view['form'] = $form->createView();
        
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Note:delete.html.twig', $view);
    }

    /**
     * @return \App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model\NoteModel
     */
    private function getModelNote() {
        return $this->container->get('app_module_notebook.model.note');
    }
    
    /**
     * @return \App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model\NotebookModel
     */
    private function getModelNotebook() {
        return $this->container->get('app_module_notebook.model.notebook');
    }
}
