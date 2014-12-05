<?php

namespace AppCommon\CommonLayoutBundle\Twig;

use AppCommon\CommonLayoutBundle\UrlAssemblyHelper;

use Symfony\Component\DependencyInjection\ContainerInterface;

class UrlTwigExtension extends \Twig_Extension
{
    protected $urlAssempblyHelper;
    
    public function __construct(UrlAssemblyHelper $urlAssempblyHelper) {
        $this->urlAssempblyHelper = $urlAssempblyHelper;
    }
    
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('appendUrlParams', array($this, 'appendUrlParams')),
        );
    }
    
    public function appendUrlParams($url, array $paramsToAdd = array(), array $paramsBaseArray = null) {
        $params = array();
        
        if(null === $paramsBaseArray) {
            $params = $_GET;
        }
        else if(false === $paramsBaseArray) {
            $params = array();
        }
        else {
            $params = $paramsBaseArray;
        }
        
        $parsed_url = $this->urlAssempblyHelper->decompile($url);
        
        // override current params with pased in link
        if(isset($decompiled['query_params'])) {
            $params = array_merge($params, $parsed_url['query_params']);
        }
        
        // override current params with explictly user-defined params
        $params = array_merge($params, $paramsToAdd);
        $parsed_url['query_params'] = $params;
        
        return $this->urlAssempblyHelper->compile($parsed_url);
    }
    
    /**
     * Set a name for the extension
     */
    public function getName() {
        return 'twig.extension.url';
    }
}
