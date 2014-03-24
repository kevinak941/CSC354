function redirect(hash) {
	$.mobile.changePage(hash, { transition: 'slide', allowSamePageTransition: false});
}

$(document).bind('pagechange', function (event, ui) {
    switch(window.location.hash) {
		case "#p_book":
			angular.element("#p_book").scope().populate();
		default:
			break;
	}
});