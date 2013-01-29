$(document).ready(function() {	

	_window_height 			= $(window).height();
	_window_width 			= $(window).width();
	_maxHeight 				= 0;
	_page_number 			= 1;
	_section_height 		= $('.story').height();	
	_last_point 			= _section_height;
	_arr_section_top 		= {};  				// FirstPoint (верхняя) и SecondPoint (нижняя) точки каждой страницы
	_max_menu_height		= 0;
	init_animate_scroll 	= 120;				// на сколько сдвигается контент при скроле
	_animate_time 			= 10;				// за сколько времени сдвигается контент за один скролл
	_delta_scroll 			= 0;
	_delta_scrollbar 		= 0;
	_current_page 			= 0;				// текущая страница на экране
	
	
	// Создаю Меню --------------------------------------------------------------
	menu_create('.holder_topic', 8, 2);
	menu_create('.holder_person', 6, 3);
	menu_create('.holder_preview', 1, 1);

	//check_window_on_resize();
	$(window).resize(function() {
		//init_all();
	});

	$("#closePopUp").live('click', function(){
		close_pop_up();
	});
	
	$("#darkFon").live("click", function(){
		close_pop_up();
	});
	
	/*$(".network.info").live("click", function(){
		send_post(HOST+'main/show_popup/', '', 'popup_callback(data)');
		$("#darkFon").show('slide', {direction: 'left'}, 300, function() {
			$("#popUp").show(200);
		});
	});*/
	
	
	/*$("#vertical_area").draggable({ 
		axis: "y",
		cursor: "move",
		scroll: false,
		grid: [0, 10],
		distance: 10,
		drag: function(event, ui) {
			//animate_objects_reset(ui.position['top'], _animate_time);
			//animate_objects(ui.position['top'], init_animate_scroll, 0, _animate_time, 1);
			if(ui.position['top'] >= 0)
				ui.draggable("disable");
			else if(ui.position['top'] <= -_last_point + _section_height)
				ui.draggable("disable");
			else if(ui.position['top'] <= -_current_page * _section_height - 300) {
				//ui.draggable("disable");
				/*var topPage = 
				var page_num = $pag.attr('data-tagcheck');
				var topPage = page_num * _section_height;
				var topVer = $('#vertical_area').position().top;
				
				animate_objects_reset(-topPage, 200);
				_current_page = page_num;
			}
		},
		stop: function(event, ui) {
			var topVer = $(this).position().top;
			if(ui.position['top'] > 0)
				animate_objects_reset(0, 200);
			else if(ui.position['top'] < -_last_point + _section_height)
				animate_objects_reset(-_last_point + _section_height, 200);
			//$(this).draggable("enable");
		}
	});*/

	
	// Задаём закрытие всех меню --------------------------------------------------------
	// по клику на close_menu или мимо Меню
	$('.close_menu').click(function() {
		close_all_menus();
	});
	$('.story').live('click', function() {
		close_all_menus();
	});
	$('.iframe_miniplayer html').live('click', function() {
		close_all_menus();
	});
	
	
	// Изначально делаем меню-лист невидимым --------------------------------------------
	// 
	$('.menu_content').each(function() {
		$(this).css('display', 'none');
		$(this).removeClass('show_block');
	});
	
	
	// ЕЩЕ ПОДКАСТ! ----------------------------------------------------------------------
	// добавление нового подкаста в конец страницы
	$('.more_podcast').click(function() {
		$more = $(this);
		$more.parent().stop().animate({opacity: 0.2}, 500, function() {		
			$more.before('<div class="hide_to_unclick pag_to_page"></div>');
			close_all_menus();	// закрываем меню
		});		
		
		send_post(HOST+'main/more_podcast/', 'topics_id='+$(this).attr('topics_id')+'&pos='+pos_count+'&load='+load_count+'&more=1', 'more_podcast_callback(data)');
	});

	
	// Анимация меню ----------------------------------------------------------------------
	// 
	$('.button').click(function() {
	
		var $button = $(this);
		var tagcheck = $button.attr('data-tagcheck');
		
		if($button.hasClass('itunes') == false) {
			if($button.hasClass('active')) {
				$button.removeClass('active');
				$('.menu_content:eq('+tagcheck+')').stop().animate({opacity: 0.0}, 300, function() {
					$(this).css('display', 'none');
					$(this).removeClass('show_block');
					$('.menu_container_holder').css('height', '0px');
					$('.menu_content_container').stop().animate({height: '0px'}, 500, function(){ $(this).css('overflow', 'hidden');});
				});
				
				//$('.menu_container_holder').animate({height: menu_width*2+'px'});
			} else {
				$('.button').each(function() { $(this).removeClass('active')} );
				close_menus_to_transit();		// закрыть все меню при клике на другую кнопку в меню и удалить классы active!
				$button.addClass('active');		// добавить класс active к конкретной кнопке
				
				// показать контент меню
				$('.menu_content:eq('+tagcheck+')').css('display', 'block');
				$('.menu_content:eq('+tagcheck+')').addClass('show_block');
				
				// устанавливаю новую высоту для menu_content_container'a
				// !!!Обязательно ПОСЛЕ того как придали menu_content состояние 'display: block'!!
				var menuHeight = $('.menu_content:eq('+tagcheck+')').height();
				$('.menu_content_container').stop().animate({height: menuHeight+100+15+'px', }, 300, function(){ 
					$(this).css('overflow', 'visible');
					$('.menu_container_holder').css('height', menuHeight+'px');
					$('.menu_content:eq('+tagcheck+')').stop().animate( {opacity: 1.0}, 500);
				});
				
			}
		}
	});

	
	// Начальное расположение некоторых элементов и их параметры -------------------------------
	init_all();
	
}); // document ready END






// -----------------------------------------------------------------------------
//
$(document).load(function() {
	
}); // document load END






// ГЛАВНЫЙ СКРИПТ! -----------------------------------------------------------------------
// 
function init_all() {
	
	_rd_fr_anmt = true;
	
	$(".network.info").live("click", function(){
		topPage = _last_point - _section_height;
		animate_objects_reset(-topPage, 1000);
		$('.pag').each(function() { $(this).removeClass('active'); });
	});
	
	$("#on_top_btn").live("click", function(){
		animate_objects_reset(0, 1000);
		$('.pag').each(function() { $(this).removeClass('active'); });
		$('.pag:eq(0)').addClass('active');
	});
	
	
	// Вызов пагинатора страниц --------------------------------------------
	$.paginatorScroll({
		scrollDuration: 1500, 
		styleClass: 'pag',
		moveClass: 'vertical_area'
	});
	
	// Местоположение пагинатора --------------------------------------------
	//var pag_right = _window_width - $('.article').position().left - $('.article').width() - 65;
	//$('.paginator').css('right', pag_right+'px');
	
	_delta_scrollbar = init_animate_scroll/_last_point*_window_height;
	
	// Начальный цвет текста на страницах и МАССИВ КООРДИНАТ ----------------
	$('.story').each(function() {
		var tagcheck = $(this).data('tagcheck');
		$(this).css('color', '#'+$(this).data('color'));
		var firPoint = $(this).position().top; 
		var secPoint = firPoint + _section_height; 
		_arr_section_top[tagcheck] = [firPoint, secPoint];
		_last_point = secPoint*1;								// устанавливаем значние максимальной высоты
	});
	
	
	// Положение линий после добавления подкастов -------------------------------
	$('.asset').each(function() {
		var dataTypeOffsetY = $(this).data('offsety');
		var dataTypeOffsetX = $(this).data('offsetx');
		
		if(dataTypeOffsetY != undefined && dataTypeOffsetY != '') {
			$(this).css('top', dataTypeOffsetY+'px');
		}
		if(dataTypeOffsetX != undefined && dataTypeOffsetX != '') {
			$(this).css('left', dataTypeOffsetX+'px');
		}
	});	
	
	
	// Основной скрипт анимации объектов! ------------------------------------------------
	// вешается на колесо мыши
	$("#main").bind("mousewheel", function(event, delta_mousewhell) {		

		var topVer = $('#vertical_area').position().top;
		
		if (delta_mousewhell > 0) {
			if(_rd_fr_anmt == true) {
				if(topVer > -init_animate_scroll/2)
					animate_objects_reset(0, _animate_time);
				else
					animate_objects(topVer, init_animate_scroll, 0, _animate_time, 0);
			}
		} else if(delta_mousewhell < 0) {
			if(_rd_fr_anmt == true) {
				if(topVer > -init_animate_scroll/2 || -topVer+_section_height < _last_point)
					animate_objects(topVer, init_animate_scroll, 1, _animate_time, 0);
				else		
					$('#vertical_area').css('top', -(_last_point-_section_height)+'px');
			}
		} else {
			//e.preventDefault();
		}
		
		return false; 
	});	
	
		
	// Основной скрипт анимации объектов! ------------------------------------------------
	// вешается на стрелки вверх/вниз
	$(document).bind('keydown', function(e) { 
		
		var topVer = $('#vertical_area').position().top;
		
		if (e.keyCode == 38) {
			if(_rd_fr_anmt == true) {
				if(topVer > -init_animate_scroll/2)
					animate_objects_reset(0, _animate_time);
				else
					animate_objects(topVer, init_animate_scroll, 0, _animate_time, 0);
			}
		} else if(e.keyCode == 40) {
			if(_rd_fr_anmt == true) {
				if(topVer > -init_animate_scroll/2 || -topVer+_section_height < _last_point)
					animate_objects(topVer, init_animate_scroll, 1, _animate_time, 0);
				else		
					$('#vertical_area').css('top', -(_last_point-_section_height)+'px');
			}
		} else {
			//e.preventDefault();
		}
		
		return false; 
	});
	$(document).unbind('keypress');
	
	
	// Отключаю middle mouse btn click ------------------------------------------
	$(document).bind('mousedown', function(e) { 
		if(e.which == 2) {}
	});
	
}
//-----------------------------------------------------------------------------------------------



// Проверяю delta_size ---------------------------------------------------------------------------
//
function check_delta_size_negative(delta_mousewhell) {
	if(delta_mousewhell < -3)
		return -3;
	else
		return delta_mousewhell;
}
function check_delta_size_positive(delta_mousewhell) {
	if(delta_mousewhell > 3)
		return 3;
	else
		return delta_mousewhell;
}
// ----------------------------------------------------------------------------------------------



// Создание переворачивания страниц. Вешается на тег-holder в меню -----------------------------
// 
function menu_create(name, count_on_page, count_in_column) {
	
	var $menu = $(name).parent();
	var $menu_two_column = $(name).children();
	var $menu_li = $menu_two_column.children();
	
	var count_in_line = Math.ceil($menu_li.length/count_in_column);
	var menu_width = $menu_li.outerWidth(true);
	var menu_height = $menu_li.outerHeight(true);

	count_in_line = count_in_line + (count_in_line%1);
	var width = menu_width * count_in_line;
	var height = menu_height * count_in_column;

	// Устанавливаю длину/высоту для меню и float-блоков -----------------------------
	$menu_two_column.css('width', menu_width+'px');
	$menu.css('height', height+'px');
	$menu.css('width', width+'px');
	
	// Прячим блоки, которые вылазят за пределы области меню ------------------------
	if($menu_li.length > count_on_page) {
		var dop_rect_left = ($(window).width() - 800)/2;
		$menu.append('<div class="hide_unnec hide_unnec_right" style="height: '+(height-5)+'px; width: '+width+'px; right: '+width+'px;"></div><div class="hide_unnec hide_unnec_left" style="height: '+(height-5)+'px; width: '+width+'px; left: '+800+'px;"></div>');
		$menu.append('<div class="navi_arrow navi_arrow_right"></div><div class="navi_arrow navi_arrow_left"></div>');
		$('.navi_arrow_left').css('opacity', 0.5);
	}
	
	// Вешаем Click на стрелки для каждого меню ---------------------------------------
	$menu.children('.navi_arrow').click(function() {
		if(_rd_fr_anmt == true) {
			var left_pos_arr = $(name).position().left;
			var $arrow = $(this);
			
			if($arrow.hasClass('navi_arrow_left')) {
				if(left_pos_arr < 0) {
					_rd_fr_anmt = false;
					$(name).stop().animate({left: left_pos_arr + menu_width+'px'}, 300, function() {
						_rd_fr_anmt = true;
						
						// Делаю стрелку неактивной/активной --------------------
						left_pos_arr = $(name).position().left;
						if(left_pos_arr == 0)
							$arrow.css('opacity', 0.5);
						else
							$arrow.css('opacity', 1);
						$menu.children('.navi_arrow_right').css('opacity', 1);
					});
				}
			} else if ($arrow.hasClass('navi_arrow_right')) {
				
				var check_width = -(width - menu_width * count_on_page/count_in_column);
				if(left_pos_arr > check_width) {					
					_rd_fr_anmt = false;
					$(name).stop().animate({left: left_pos_arr - menu_width+'px'}, 300, function() {
						_rd_fr_anmt = true;
						
						// Делаю стрелку неактивной/активной ----------------------
						left_pos_arr = $(name).position().left;
						if(left_pos_arr == check_width)
							$arrow.css('opacity', 0.5);
						else
							$arrow.css('opacity', 1);
						$menu.children('.navi_arrow_left').css('opacity', 1);
						
					});
				}
			}
		}
		return false;
	});
}
//----------------------------------------------------------------------------------------------



// Параллакс-анимация при движениях вниз/вверх ----------------------------------------------
// 
function animate_objects(topVer, animate_scroll, delta, time, drager) {
	_rd_fr_anmt = false;
	
	if(drager == 0) {
		if(delta == 1) {		
			$('#vertical_area').stop().animate({top: topVer-animate_scroll+'px'}, time, function() {
				_rd_fr_anmt = true;
			});
		} else {
			$('#vertical_area').stop().animate({top: topVer+animate_scroll+'px'}, time, function() {
				_rd_fr_anmt = true;
			});
		}
	}

	if(animate_scroll > _section_height)
		animate_scroll = _section_height;
	
	$('.story').each(function() {
			
		var $self = $(this),
			offsetCoords = $self.offset(),
			topOffset = offsetCoords.top;
			//selfHeight = $self.height();
			//leftOffset = offsetCoords.left;
						
		var pageDataTagcheck = $self.attr('data-tagcheck');
						
		if ((-topVer >= _arr_section_top[pageDataTagcheck][0] && -topVer <= _arr_section_top[pageDataTagcheck][1]) || 
			(-topVer >= _arr_section_top[pageDataTagcheck][0]-_window_height && -topVer <= _arr_section_top[pageDataTagcheck][1]-_window_height)) {
			
			change_pag(pageDataTagcheck);
			
			if(delta == 1) {			
				var yPos = ((-topOffset + animate_scroll) / 1.1); 				//// !!!!!!!!!!!!!
			} else {
				var yPos = ((-topOffset - animate_scroll) / 1.1); 				//// !!!!!!!!!!!!!
			}
			
			var $self_bg = $self.children('.bg_img');
			var $self_bgfon = $self.children('.bg_fonimage');
			var $self_assets = $self.children('.assets');
			var $self_article = $self.children('.article');
			var $self_picture = $self.children('.picture').children('img');	
			
			var topArticle = $self_article.attr('data-positionY')*1;
							
			$self_bg.stop().animate( {top: yPos+'px'}, time);
			$self_bgfon.stop().animate( {top: yPos+'px'}, time);
			var i = 1;
			$self_picture.each(function() {
				$(this).stop().animate( {top: yPos/1.5/i+'px'}, time);
				i++;
			});
			$self_assets.stop().animate( {top: yPos*1.2+'px'}, time);
			$self_article.stop().animate( {top: yPos/1.2+topArticle+'px'}, time);
		}
	});
}
//--------------------------------------------------------------------------------



// Параллакс-анимация  -----------------------------------------------------------
// при пагинации или доходе до верха/низа страниц
function animate_objects_reset(pixels, time) {
	var topVer = $('#vertical_area').position().top;
	
	if(topVer != pixels && topVer > -80 && topVer < 0) {
		_rd_fr_anmt = false;
		$('#vertical_area').stop().animate({top: '0px'}, time, function() {
			_rd_fr_anmt = true;
		});
	} else if(topVer == pixels) {
		_rd_fr_anmt = false;
		$('#vertical_area').stop().animate({top: pixels+'px'}, time, function() {
			_rd_fr_anmt = true;
		});
	} else {
		$('#vertical_area').stop().animate({top: pixels+'px'}, time, function() {
			_rd_fr_anmt = true;
		});
	}
	

	$('.story').each(function() {
			
		var $self = $(this),
		offsetCoords = $self.offset(),
		topOffset = offsetCoords.top,
		selfHeight = $self.height();
		//leftOffset = offsetCoords.left;
						
							
		var $self_bg = $self.children('.bg_img');
		var $self_bgfon = $self.children('.bg_fonimage');
		var $self_assets = $self.children('.assets');
		var $self_article = $self.children('.article');
		var $self_picture = $self.children('.picture').children('img');	
		var topArticle = $self_article.attr('data-positionY')*1;
							
		$self_bg.stop().animate( {top: '0px'}, time);
		$self_bgfon.stop().animate( {top: '0px'}, time);
		var i = 1;
		$self_picture.each(function() {
			$(this).stop().animate( {top: '0px'}, time);
			i++;
		});
		$self_assets.stop().animate( {top: '0px'}, time);
		$self_article.stop().animate( {top: topArticle+'px'}, time);
	});

}


// Закрыть все Меню  ------------------------------------------------------------------
// при переходе от категории к категории
function close_menus_to_transit() {
	$('.menu_content').each(function () {
		if($(this).hasClass('show_block')) {
			$(this).stop().animate({opacity: 0.0}, 200, function() {
				$(this).css('display', 'none');
				$(this).removeClass('show_block');
			});
		}
	});	
}



// Закрыть все меню вообще! ------------------------------------------------------------
// 
function close_all_menus() {
	close_menus_to_transit();
	$('.menu_content_container').stop().animate({height: '0px'}, 1000, function(){
		$(this).css('overflow', 'hidden');
		$('.menu_container_holder').css('height', '0px');
	});
	$('.button').each(function() { $(this).removeClass('active')} );
}



// Изменить активный пагинатор ----------------------------------------------------------
// 
function change_pag(pageDataTagcheck) {
	_current_page = pageDataTagcheck;
	$('.pag').each(function() { $(this).removeClass('active'); });
	$('.pag:eq('+pageDataTagcheck+')').addClass('active');
}



// Пагинация к странице ------------------------------------------------------------------
// 
function paginate_to_page($pag) {
	//if(drag == 1)
	//	var page_num = _current_page + 1;
		
	var page_num = $pag.attr('data-tagcheck');
	var topPage = page_num * _section_height;
	var topVer = $('#vertical_area').position().top;
	
	animate_objects_reset(-topPage, 200);
	_current_page = page_num;
	
	$('.pag').each(function() { $(this).removeClass('active'); });
	$pag.addClass('active');
}



// Действие при изменении размера окна --------------------------------------------------------
// 
function check_window_on_resize() {
	var htmlWidth = $('html').css('min-width').split('px')[0]*1;
	
	if($(window).width() <= htmlWidth) { 
		var width = htmlWidth;
		$('html').css('overflow-x', 'show');
	} else {
		var width = $(window).width();
	}
	 
	$(document).width(width);
	$('html').css('width', width+'px');
	$('#main').css('width', width+'px');
	$('#clickable').css('width', width+'px');
	//$('html').css('width', width+'px');
}



// Принимаю JSON и показываю новый подкаст -------------------------------------------------------------
// 
function more_podcast_callback(data) {
	
	// Декодирую JSON-данные
	var data = jQuery.parseJSON(data);
	
	$('.pag').each(function() { $(this).removeClass('active'); });
	
	// Выводим новые данные ПЕРЕД последним pag/story
	$('.pag.last').before(data['paginators']);
	$('.story.last').before(data['pages']);
	
	// Удаляем <br> теги (особенность пыховской функции show_tpl)
	$('.paginator').find('br').remove();
	
	// Если массив pages пуст - значит и страниц больше нет.
	if(data['pages'] != '' && data['pages'] != undefined) {
		var topPage = pos_count * _section_height;
		pos_count ++ ;
		$('#vertical_area').stop().animate({ top: -topPage + 'px'}, 1100);
		
		//var offsetTopMore = (pos_count * _section_height) + 50;
		

	}
	
	// Заново инициализирую начальные параметры ----------------------
	init_all();

}



// -----------------------------------------------------------------------------
//
function send_post(url, data, callback) {
	$.ajax({
		type: 'POST',
		url: url,
		data: data,
		 success: function(data){
			eval(callback);
	    }
	});
}




/*/ РАБОТА С POP_UPом -------------------------------------------------------------
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
// ------------------------------------------------------------------------------- */