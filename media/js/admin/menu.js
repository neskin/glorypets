$(document).ready(function(){
	menu_init();
	
	$("li.has_submenu").children('div').click(function(){oc_submenu($(this).parent('li'))});
});

function oc_submenu(e){
	if(e.hasClass('open')){
		$.cookie('open_submenu['+e.index()+']', null)
		e.removeClass('open');
	}else{
		$.cookie('open_submenu['+e.index()+']', '1')
		e.addClass('open');
	}
}

function menu_init(){
	$("ul#menu").children("li.has_submenu").each(function(){
		$(this).append('<span class="sub_selector"></span>');
		if($.cookie('open_submenu['+$(this).index()+']') == 1)
			$(this).addClass('open');
	});
}