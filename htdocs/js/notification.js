function show_note(type, text) {
	$('div.notification')	.addClass(type)
							.html(text).slideDown()
							.click(hide_note);
	
}

function hide_note() {
	$('div.notification').slideUp();
}