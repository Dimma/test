// Get chat messages from DB every 5 seconds
setInterval(function() {
	$.ajax({
		type	: 'POST',
		url		: baseUrl + '/chat/messages',
		success	: function(data){
			if (undefined != typeof(data)) {
				var text	= '';
				data		= $.parseJSON(data);
				$.each(data, function(id, field) {
					text += field.create_time
						+ ' <strong>' + field.author + ':</strong> '
						+ field.content + '<br/>';
				});
				$('.chatInput').html(text);
			}
		}
	});
}, 5000);

// Handler to show/hide chat window
$('#arrow').live('click', function() {
	$('#chatWindow').toggle();
	// Toggle arrow from > to <, and on the contrary
	$('#arrow').html((undefined != $('#chatWindow:visible').val() ? '&lt;' : '&gt;'));
});

// Event handler for send message to chat
$('[name=yt0][value=Send]').live('click', function(e) {
	e.preventDefault();
	$.ajax({
		type	: 'POST',
		url		: baseUrl + '/chat/newMessage',
		data	: {message: $('#Messages_content').val()},
		success	: function() {
			$('#Messages_content').val('');
		}
	});
});