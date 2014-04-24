function show_note(type, text) {
	$('div.notification')	.addClass('note-open')
							.addClass(type)
							.html(text).slideDown()
							.click(hide_note);
	setTimeout(function() {
		hide_note();
	}, 2000);
}

function hide_note() {
	$('div.notification.note-open').slideUp();
}