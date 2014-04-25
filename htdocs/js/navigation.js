function redirect(hash) {
	$.mobile.changePage(hash, { transition: 'slide', allowSamePageTransition: false});
}

$(function() {
	$('.nav-dashboard').click(function() {
		angular.element("#p_feed").scope().selected_user(null);
		angular.element("#p_dashboard").scope().get();
	});
});

$(document).bind('pagebeforeshow', function (event, ui) {
    switch(window.location.hash) {
		case "#p_dashboard":
			angular.element("#p_dashboard").scope().get();
			break;
		case "#p_ranks":
			angular.element("#p_ranks").scope().populate();
			break;
		case "#p_feed":
			angular.element("#p_feed").scope().populate();
			break;
		case "#p_edit_profile":
			angular.element("#p_edit_profile").scope().populate();
			break;
		case "#p_book":
			angular.element("#p_book").scope().populate();
			break;
		case "#p_object_view":
			angular.element("#p_object_view").scope().populate();
			break;
		case "#p_object_edit":
			angular.element("#p_object_edit").scope().populate();
			break;
		case "#p_achievements":
			angular.element("#p_achievements").scope().populate();
			break;
		case "#p_stats":
			angular.element("#p_stats").scope().populate();
			break;
		default:
			break;
	}
	$('a[data-role="button"]').button();
});