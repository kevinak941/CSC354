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
		}
	}
}