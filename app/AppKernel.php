<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            // commons
            new AppCommon\CommonLayoutBundle\AppCommonCommonLayoutBundle(),
            new AppCommon\CommonModelBundle\AppCommonCommonModelBundle(),
            new AppCommon\CommonMailBundle\AppCommonCommonMailBundle(),

            // security
            new FOS\UserBundle\FOSUserBundle(),
            
            // api
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            
            new AppBundle\AppBundle(),
            
            new App\ModuleUser\Bundle\ModuleUserBundle\AppModuleUserModuleUserBundle(),
            new App\ModuleUser\Bundle\ModuleUserApiBundle\AppModuleUserModuleUserApiBundle(),
            
            new App\ModuleNotebook\Bundle\ModuleNotebookBundle\AppModuleNotebookModuleNotebookBundle(),
            new App\ModuleNotebook\Bundle\ModuleNotebookUiBundle\AppModuleNotebookModuleNotebookUiBundle(),
            new App\ModuleNotebook\Bundle\ModuleNotebookApiBundle\AppModuleNotebookModuleNotebookApiBundle(),
            
            // libs
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new App\CommonLayoutBundle\AppCommonLayoutBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
