<?php

namespace AppCommon\CommonMailBundle;

interface MailBuilder {
	/**
	 * @return \Swift_Mesage
	 */
	public function buildMessage($body, $subject, $recipient = null);
}
