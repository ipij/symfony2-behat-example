<?php

namespace AppCommon\CommonLayoutBundle\FlashMessenger\Message;

use AppCommon\CommonLayoutBundle\FlashMessenger\AbstractMessage;

class InfoMessage extends AbstractMessage
{
    public function getType()
    {
        return "info";
    }
	
	protected function getDefaultHeader() {
		return 'Heads up!';
	}
}
