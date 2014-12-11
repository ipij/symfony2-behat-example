<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppCommon\CommonLayoutBundle\FlashMessenger\MessageFactory;
use App\ModuleNotebook\Bundle\ModuleNotebookBundle\Entity\Notebook;

class NotebookController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        if(! $this->get('security.context')->isGranted('notebook.list')) {
            throw $this->createAccessDeniedException();
        }
        
        $view = [];
        
        $params = [];
        $paramsListing = $params + [
            'returnQuery' => true,
            'ownerId' => $this->getUser()->getId(),
        ];
        
        $model = $this->getModelNotebook();
        
        $page = (int) $request->query->get('page', 1);
        $pageLimit = 10;
        
        /* @var $paginator \Knp\Component\Pager\PaginatorInterface */
        $paginator = $this->container->get('knp_paginator');
        /* @var $pagination \Knp\Component\Pager\Pagination\AbstractPagination */
        $pagination = $paginator->paginate($model->getList($paramsListing), $page, $pageLimit, [
//             'defaultSortFieldName' => 'item.name',
//             'defaultSortDirection' => 'asc',
        ]);
        
        $view['itemsPagination'] = $pagination;
        $view['items'] = $pagination->getItems();
        
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Notebook:index.html.twig', $view);
    }
    
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        if(! $this->get('security.context')->isGranted('notebook.create')) {
            throw $this->createAccessDeniedException();
        }
    
        $view = [];

        $model = $this->getModelNotebook();
        
        $entity = new Notebook();
        
        $form = $this->createForm('notebook', $entity);
        $form->handleRequest($request);
        
        if($form->isValid()) {
            
            $entity->setOwner($this->getUser());
            
            $model->save($entity);
            
            $this->get('session')->getFlashBag()->add(
                'notice',
                MessageFactory::createMessage('The notebook has been added successfully.')
            );
            
            return $this->redirect($this->generateUrl('app_module_notebook.ui.notebook.view', [
                'slug' => $entity->getSlug(),
            ]));
        }
        
        $view['item'] = $entity;
        $view['form'] = $form->createView();
        
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Notebook:create.html.twig', $view);
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $slug)
    {
        $model = $this->getModelNotebook();
        
        $entity = $model->getBySlugAndUser($slug, $this->getUser()->getId());
        
        if(null === $entity) {
            throw $this->createNotFoundException();
        }
        
        if(! $this->get('security.context')->isGranted('notebook.update', $entity)) {
            throw $this->createAccessDeniedException();
        }

        $view = [];
        
        $form = $this->createForm('notebook', $entity);
        $form->handleRequest($request);
    
        if($form->isValid()) {
    
            $entity->setOwner($this->getUser());
    
            $model->save($entity);
    
            $this->get('session')->getFlashBag()->add(
                'notice',
                MessageFactory::createMessage('The notebook has been updated successfully.')
            );
    
            return $this->redirect($this->generateUrl('app_module_notebook.ui.notebook.view', [
                'slug' => $entity->getSlug(),
            ]));
        }
    
        $view['item'] = $entity;
        $view['form'] = $form->createView();
    
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Notebook:update.html.twig', $view);
    }
    
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request, $slug)
    {
        $model = $this->getModelNotebook();
        
        $entity = $model->getBySlugAndUser($slug, $this->getUser()->getId());
        
        if(null === $entity) {
            throw $this->createNotFoundException();
        }
        
        if(! $this->get('security.context')->isGranted('notebook.delete', $entity)) {
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
                
                return $this->redirect($this->generateUrl('app_module_notebook.ui.notebook.list'));
            }
        }
        
        $view['item'] = $entity;
        $view['form'] = $form->createView();
        
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Notebook:delete.html.twig', $view);
    }
    
    /**
     * @return \App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model\NotebookModel
     */
    private function getModelNotebook() {
        return $this->container->get('app_module_notebook.model.notebook');
    }
}
