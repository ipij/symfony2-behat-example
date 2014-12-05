<?php

namespace AppCommon\CommonLayoutBundle\FlashMessenger;

abstract class AbstractMessage
{
    /**
     * 
     * @var string
     */
    protected $message = null;
    
	/**
     * 
     * @var string
     */
    protected $header = null;
	
	/**
	 *
	 * @var array
	 */
	protected $arguments = [];
	
    /**
     *
     * @var boolean
     */
    protected $closeable = null;
    
    public function __construct($message = null, $header = null, $arguments = null)
    {
        if(null !== $message)
            $this->setMessage($message);
		
		if(null !== $arguments)
            $this->setArguments($arguments);
		
		if(null !== $header) {
            $this->setHeader($header);
		} else {
			$this->setHeader($this->getDefaultHeader());
		}
    }
    
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

	/**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
	
	/**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

	/**
     * @param string $message
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }
	
	/**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

	/**
     * @param array $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }

	/**
     * @return boolean
     */
    public function isCloseable()
    {
        return $this->closeable;
    }

	/**
     * @param boolean $closeable
     */
    public function setCloseable($closeable)
    {
        $this->closeable = $closeable;
    }

	abstract function getType();
	
	abstract protected function getDefaultHeader();
}
