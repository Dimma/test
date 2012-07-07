<?php
/**
 * Chat class file.
 *
 * @author	Dmitriy Chizhov <dmmsskn@gmail.com>
 */

Yii::import('zii.widgets.CPortlet');

/**
 * Chat displays a side-bar chat window that toggle between show and hide.
 *
 * The main property of Chat is {@link maxMessages}, which specifies the maximum
 * displayed messages in chat window.
 *
 * The following example shows how to use Chat:
 * <pre>
 * <div id="chat">
 *		<?php $this->widget('ext.chat.Chat'); ?>
 * </div>
 * </pre>
 *
 *
 * @author	Dmitriy Chizhov	<dmmsskn@gmail.com>
 * @version	$Id: Chat.php 2012-07-06 22:54 $
 * @package	zii.widgets
 * @since	1.1
 */
class Chat extends CPortlet
{
	/**
	 * Number of maximum messages, displayed in chat window.
	 * Default to 15.
	 * @var		int
	 */
	public $maxMessages	= 15;

	/**
	 * Get last {@link maxMessages} messages from database
	 * @access	public
	 * @return	array
	 */
	public function getChatMessages()
	{
		return Messages::model()->getMessages($this->maxMessages);
	}

	/**
	 * Render content
	 * @access	protected
	 */
	protected function renderContent()
	{
		$this->render('chat', array('model' => Messages::model()));
	}
}

?>
