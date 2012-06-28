<div id="chat">
	<?php
		$cs = Yii::app()->getClientScript();
		$cs->registerScript(
			'myScript',
			"
				function chatPinger()
				{
					$.ajax({
						type	: 'POST',
						url		: '".Yii::app()->request->baseUrl."/index.php/chat/messages',
						success	: function(data){
							if (undefined != typeof(data)) {
								data = $.parseJSON(data);
								var text = '';
								var mDate, mYear, mMonth, mDay, mHours, mMinute;
								$('.chatInput').html('');

								$.each(data, function(id, field) {
									mDate	= new Date(field.create_time * 1000);
									mDay	= mDate.getDate();
									mMonth	= mDate.getMonth() + 1;
									mYear	= mDate.getFullYear();
									mHours	= mDate.getHours();
									mMinute	= mDate.getMinutes();
									mDate	= mDay + '/' + mMonth + '/' + mYear + ' ' + mHours + ':' + mMinute;
									text	+= mDate + ' <strong>' + field.author + ':</strong> '
											+ field.content + '<br/>';
								});
								$('.chatInput').html(text);
							}
						}
					});
				}
				setInterval(chatPinger, 5000);
				$('#arrow').click(function() { $('#chatWindow').toggle(); });

				$('[name=yt0][value=Send]').click(function(e) {
					e.preventDefault();
					$.ajax({
						type	: 'POST',
						url		: '".Yii::app()->request->baseUrl."/index.php/chat/newMessage',
						data	: {message: $('#Messages_content').val()},
						success	: function() {
							$('#Messages_content').val('');
						}
					});
				});
			",
			CClientScript::POS_READY
		);
	?>
	<div id="arrow"></div>
	<div id="chatWindow">
		<div class="chatInput">
			<?php foreach ($this->getChatMessages() as $message) : ?>
				<?php echo date('j/n/Y h:i', $message->create_time); ?>
				<strong><?php echo $message->author; ?>:</strong>
				<?php echo CHtml::encode($message->content); ?>
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
</div>