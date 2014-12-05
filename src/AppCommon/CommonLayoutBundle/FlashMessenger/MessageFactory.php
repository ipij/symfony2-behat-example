<?php

namespace AppCommon\CommonLayoutBundle\FlashMessenger;

use AppCommon\CommonLayoutBundle\FlashMessenger\Message as Message;

class MessageFactory
{
    public static function createMessage($message, $type = 'success', $header = null, $arguments = null)
    {
        $msg = null;
        
        switch ($type) {
            case 'success':
                $msg = new Message\SuccessMessage($message, $header, $arguments);
                break;
			case 'error':
                $msg = new Message\ErrorMessage($message, $header, $arguments);
                break;
            case 'info':
                $msg = new Message\InfoMessage($message, $header, $arguments);
                break;
			
            default:
                throw new \InvalidArgumentException('Unknown type.');
        }
        
        $msg->setCloseable(true);
        
        return $msg;
    }
}
