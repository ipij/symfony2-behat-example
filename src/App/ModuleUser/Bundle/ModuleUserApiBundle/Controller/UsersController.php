<?php
namespace App\ModuleUser\Bundle\ModuleUserApiBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\View\View,
    FOS\RestBundle\View\ViewHandler,
    FOS\RestBundle\View\RouteRedirectView,
    FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UsersController
{

    /**
     *
     * @var Container
     */
    public $container;
    
    /**
     *
     * @var ViewHandler
     */
    public $viewHandler;
    
    /**
     * @ApiDoc()
     *
     * @Rest\QueryParam(name="page", requirements="\d+", default=1)
     * @Rest\QueryParam(name="pageLimit", requirements="\d+", default=10)
     */
    public function getUsersAction(Request $request)
    {
        /* @var $model \App\ModuleObjectsBundle\Model\MapObjectModel */
        $model = $this->container->get('app_module_user.model.user');
        
        $params = [];
        
        $params = [
            'returnQuery' => true
        ];
        $query = $model->getList($params);
        
        $page = (int) $request->query->get('page', 1);
        $pageLimit = (int) $request->query->get('pageLimit', 10);
        
        /* @var $paginator \Knp\Component\Pager\PaginatorInterface */
        $paginator = $this->container->get('knp_paginator');
        /* @var $pagination \Knp\Component\Pager\Pagination\AbstractPagination */
        $pagination = $paginator->paginate($query, $page, $pageLimit);
        
        $data = array(
            'itemsPagination' => $pagination,
            'items' => $pagination->getItems()
        );
        
        $view = new View();
        $view->setData($data);
        $context = new SerializationContext();
        $context->setGroups(array(
            '.all',
            'user.list'
        ));
        $view->setSerializationContext($context);
        
        return $this->viewHandler->handle($view);
    }

    /**
     * @ApiDoc
     *
     * @param integer $objectId            
     * @throws NotFoundHttpException
     */
    public function getUserAction($userId = 0)
    {
        /* @var $model \App\ModuleObjectsBundle\Model\MapObjectModel */
        $model = $this->container->get('app_module_user.model.user');
        
        $data = $model->findOneById($userId);
        
        if (null === $data)
            throw new NotFoundHttpException();
        
        $view = new View();
        $view->setData($data);
        $context = new SerializationContext();
        $context->setGroups(array(
            '.all',
            'user.get'
        ));
        $view->setSerializationContext($context);
        
        return $this->viewHandler->handle($view);
    }
}
