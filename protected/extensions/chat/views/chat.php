<div id="arrow">></div>
<div id="chatWindow">
	<div class="chatInput">
		<?php foreach ($this->getChatMessages() as $message) : ?>
			<?php echo Yii::app()->format->formatDateTime($message->create_time); ?>
			<strong><?php echo $message->author; ?>:</strong>
			<?php echo $message->content; ?>
			<br/>
		<?php endforeach; ?>
	</div>
	<div class="submitInput">
		<?php $form = $this->beginWidget('CActiveForm'); ?>
		<?php echo $form->textField($model, 'content'); ?>
		<?php echo CHtml::submitButton('Send'); ?>
		<?php $this->endWidget(); ?>
	</div>
</div>