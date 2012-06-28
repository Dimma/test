<?php

class ChatController extends Controller
{
	/**
	 * Return chat messages
	 */
	public function actionMessages()
	{
		if (Yii::app()->request->isAjaxRequest) {
			echo CJSON::encode(Messages::model()->findMessages());
		}
	}

	/**
	 * Creates a new message
	 */
	public function actionNewMessage()
	{
		$message = new Messages;
		if (!empty($_POST['message'])) {
			$message->addMessage($_POST['message']);
		}
	}
}
