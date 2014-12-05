<?php

namespace AppCommon\CommonLayoutBundle\FlashMessenger\TwigExtension;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Templating\EngineInterface;

class FlashMessengerTwigExtension extends \Twig_Extension
{
    protected $container;
    
    protected $template;

    /**
     * Receive Router instance
     */
    public function __construct(ContainerInterface $container, $template)
    {
        $this->container = $container;
        $this->template = $template;
    }

    /**
     * Declare the asset_url function
     */
    public function getFunctions()
    {
        return array(
            'flash_messenger' => new \Twig_Function_Method($this, 'flashMessenger'),
        );
    }
    
    public function flashMessenger(array $noticesFlashBag, $template = null) {
        if(null === $template)
            $template = $this->template;
        
        return $this->container->get('templating')->render($template, array(
            'noticesFlashBag' => $noticesFlashBag,
        ));
    }
    
    /**
     * Set a name for the extension
     */
    public function getName()
    {
        return 'twig.extension.flashMessenger';
    }
}
