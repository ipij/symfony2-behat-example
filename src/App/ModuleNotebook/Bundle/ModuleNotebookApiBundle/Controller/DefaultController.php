<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AppModuleNotebookModuleNotebookApiBundle:Default:index.html.twig', array('name' => $name));
    }
}
