
function catch_validation(response) {
	if(response.hasOwnProperty('status')) {
		if(response.status == "validate") {
			jQuery.each(response.data.errors, function(i, item) {
				if($('#'+item.name).parent('div').hasClass('is_error')) {
					
					$('#'+item.name).parent('div').next('.error').html(item.message);
				} else {
					console.log(item);
					$('#'+item.name).parent('div').addClass('is_error')
									.after($('<div></div>').html(item.message).addClass('error'));
				}
			});
		}
	}
}