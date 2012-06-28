<?php

class Chat extends CWidget
{

	public function init()
	{
		$this->author = $this->account_hash;

		$this->isOnline();
		$this-> _getStatus();
	}
}

?>
