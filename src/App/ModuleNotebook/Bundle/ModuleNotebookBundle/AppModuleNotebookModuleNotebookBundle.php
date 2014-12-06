<?php

namespace App\ModuleNotebook\Bundle\ModuleNotebookBundle;

use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;

class AppModuleNotebookModuleNotebookBundle extends AbstractResourceBundle
{
    /* (non-PHPdoc)
     * @see \Sylius\Bundle\ResourceBundle\ResourceBundleInterface::getSupportedDrivers()
     */
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }
    
	/* (non-PHPdoc)
     * @see \Sylius\Bundle\ResourceBundle\AbstractResourceBundle::getBundlePrefix()
     */
    protected function getBundlePrefix()
    {
        return 'app_module_notebook';
    }
    
    protected function getModelInterfaces()
    {
        return array(
//             'App\ModuleNotebook\Component\Notebook\Model\NoteInterface' => 'app_module_notebook.model.note.class',
            'App\ModuleNotebook\Component\Notebook\Model\NoteTagInterface' => 'app_module_notebook.model.noteTag.class',
        );
    }
    
    protected function getModelNamespace()
    {
        return 'App\ModuleNotebook\Component\Notebook\Model';
    }
}
