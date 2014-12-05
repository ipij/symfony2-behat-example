<?php

namespace AppCommon\CommonLayoutBundle\FlashMessenger\Message;

use AppCommon\CommonLayoutBundle\FlashMessenger\AbstractMessage;

class SuccessMessage extends AbstractMessage
{
    public function getType()
    {
        return "success";
    }
	
	protected function getDefaultHeader() {
		return 'Great!';
	}
}
