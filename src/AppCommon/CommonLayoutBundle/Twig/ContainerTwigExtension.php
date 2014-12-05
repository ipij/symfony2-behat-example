<?php

namespace AppCommon\CommonLayoutBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerTwigExtension extends \Twig_Extension
{

  protected $container;

  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function getGlobals()
  {
    return array('container' => $this->container);
  }

  public function getFunctions()
  {
    return array('param' => new \Twig_Function_Method($this, 'getContainerParameter'));
  }

  public function getContainer()
  {
    return $this->container;
  }

  public function getContainerParameter($name)
  {
    return $this->container->getParameter($name);
  }

  /**
   * Set a name for the extension
   */
  public function getName()
  {
    return 'twig.extension.container';
  }
}
