<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
        $view = [];
        
        $params = [];
        $paramsListing = $params + [
            'returnQuery' => true,
        ];
        
        $model = $this->getModelNotebook();
        
        $page = (int) $request->query->get('page', 1);
        $pageLimit = 10;
        
        /* @var $paginator \Knp\Component\Pager\PaginatorInterface */
        $paginator = $this->container->get('knp_paginator');
        /* @var $pagination \Knp\Component\Pager\Pagination\AbstractPagination */
        $pagination = $paginator->paginate($model->getList($paramsListing), $page, $pageLimit);
        
        $view['itemsPagination'] = $pagination;
        $view['items'] = $pagination->getItems();
        
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Notebook:index.html.twig', $view);
    }
    
    /**
     * @return \App\ModuleNotebook\Bundle\ModuleNotebookBundle\Model\NotebookModel
     */
    private function getModelNotebook() {
        return $this->container->get('app_module_notebook.model.notebook');
    }
}
