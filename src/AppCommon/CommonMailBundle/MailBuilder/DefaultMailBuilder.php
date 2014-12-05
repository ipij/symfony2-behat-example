<?php

namespace AppCommon\CommonMailBundle\MailBuilder;

use AppCommon\CommonMailBundle\MailBuilder;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class DefaultMailBuilder implements ContainerAwareInterface, MailBuilder {
	
	/**
	 * @var Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;
	
	public function __construct(ContainerInterface $container) {
	  $this->setContainer($container);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Symfony\Component\DependencyInjection.ContainerAwareInterface::setContainer()
	 */
	public function setContainer(ContainerInterface $container = null) {
		$this->container = $container;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see AppCommon\CommonMailBundle.MailBuilder::buildMessage()
	 */
	public function buildMessage($body, $subject, $recipient = null) {
		$message = new \Swift_Message();
		$message->setFrom($this->container->getParameter('mailer_sender'), $this->container->getParameter('mailer_sender_name'));
		
		$message->setSubject($subject);
		$message->setBody($body);
		$message->setContentType('text/html');
		
		if(null !== $recipient)
			$message->setTo($recipient);
		
		return $message;
	}
}
