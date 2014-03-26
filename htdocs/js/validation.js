/**
 * Catches a json response with status property set to "validate"
 * Data property contains property errors which is an array containing objects {name, message}
 */
function catch_validation(response) {
	if(response.hasOwnProperty('status')) {
		if(response.status == "validate") {
			$('.is_error').removeClass('is_error').next('.error').remove();
			jQuery.each(response.data.errors, function(i, item) {
				if($('#'+item.name).parent('div').hasClass('is_error')) {
					$('#'+item.name).parent('div').next('.error').html(item.message);
				} else {
					$('#'+item.name).parent('div').addClass('is_error')
									.after($('<div></div>').html(item.message).addClass('error'));
				}
			});
			return false;
		}
		catch_notification(response.data);
		if(response.status == "success") return true;
	}
	return false;
}

/**
 * Pass data object from ajax response to catch a notification
 * Catches notifications to display on the page
 */
function catch_notification(data) {
	// Check if response contains a notification
	if(data.hasOwnProperty('note')) {
		// Read notification
		var type = data.note.hasOwnProperty('type') ? data.note.type : "";
		var text = data.note.hasOwnProperty('text') ? data.note.text : "";
		show_note(type, text);
	}
}