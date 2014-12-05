<?php

namespace AppCommon\CommonLayoutBundle\FlashMessenger\Message;

use AppCommon\CommonLayoutBundle\FlashMessenger\AbstractMessage;

class ErrorMessage extends AbstractMessage
{
    public function getType()
    {
        return "danger";
    }
	
	protected function getDefaultHeader() {
		return 'Oops!';
	}
}
