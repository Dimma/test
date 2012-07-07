<?php

class ChatController extends Controller
{
	/**
	 * Filters
	 * @acces	public
	 * @return	array
	 */
	public function filters()
	{
		return array('ajaxOnly + messages');
	}

	/**
	 * Get chat messages from model and convert datetime to normal format
	 * @access	public
	 */
	public function actionMessages()
	{
		$messages = Messages::model()->getMessages();
		foreach ($messages as &$message) {
			$message->create_time = Yii::app()->format->formatDateTime($message->create_time);
		}
		echo CJSON::encode($messages);
	}

	/**
	 * Creates a new message and adding it to database
	 * @access	public
	 */
	public function actionNewMessage()
	{
		$message = new Messages;
		if (!empty($_POST['message'])) {
			$message->addMessage(CHtml::encode($_POST['message']));
		}
	}
}
