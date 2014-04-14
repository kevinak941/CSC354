function init_menu() {
	var $drop = $('#dropdown_menu');
	$drop.width($(window).width()+"px");
	$('#dropdown_menu ul li a').each(function(i, ele) {
		$(ele).click(function(e) {
			show_menu($('#'+ $.mobile.activePage.attr('id')).find('.ui-btn-left')[0]);
		});
	});
}

function show_menu(ele) {
	if(ele !== undefined) {
		if($(ele).hasClass('menu-open')) {
			hide_menu();
			$(ele).removeClass('menu-open');
		} else {
			$(ele).addClass('menu-open');
			show_menu();
		}
	} else {
		$('#dropdown_menu').width($.mobile.activePage.width()+"px");
		$('#dropdown_menu').show();
	}
}
function hide_menu() {
	$('#dropdown_menu').hide();
}