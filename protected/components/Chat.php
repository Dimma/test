<?php

Yii::import('zii.widgets.CPortlet');

class Chat extends CPortlet
{
	public $maxMessages	= 15;

	public function getChatMessages()
	{
		return Messages::model()->findMessages($this->maxMessages);
	}

	protected function renderContent()
	{
		$this->render('chat', array('model' => Messages::model()));
	}
}

?>
