$(document).ready(function() {
	
	//----------------------------------------------------------------------
	// Задаём закрытие всех меню по клику на close_menu или мимо Меню
	$('.close_menu').click(function() {
		close_all_menus();
	});
	$('.story').live('click', function() {
		close_all_menus();
	});
	$('.iframe_miniplayer html').live('click', function() {
		close_all_menus();
	});

	//----------------------------------------------------------------------
	// ЕЩЕ ПОДКАСТ! добавление нового подкаста в конец страницы
	$('.article h1').click(function() {
		var tagcheck = $(this).parent().parent().attr('data-tagcheck');
		send_post(HOST+'main/show_podcast_info/', 'topics_id='+$(this).parent().attr('topics_id'), 'info_podcast_callback(data, tagcheck)');
	});

}); // document ready END





function info_podcast_callback(data, tagcheck) {
	var $podc = $('.story:q('+tagcheck+')').children('.article').children('.info_podcast');
	$podc.html(data);
	$podc.show(200);
	
}


// РАБОТА С POP_UPом -------------------------------------------------------------
//
function close_pop_up(){
	$('#popUpContainer').html('');
	$("#popUp").hide(200, function() {
		$("#darkFon").hide('slide', {direction: 'right'}, 300);
	});
}

function popup_callback(data) {
	$('#popUpContainer').html(data);
}
// -------------------------------------------------------------------------------