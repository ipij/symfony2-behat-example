<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends Controller
{
    public function indexAction(Request $request)
    {
        $view = [];
        return $this->render('AppModuleNotebookModuleNotebookUiBundle:Homepage:index.html.twig', $view);
    }
}
