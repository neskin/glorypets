
$(document).ready(function() {	

	/*$mp3 = "media/persons/"+_page_number+"/persons"+_page_number+".mp3";
	$oga = "media/persons/"+_page_number+"/persons"+_page_number+".ogg";
	
	$(window).scroll(function() {
		$mp3 = "media/persons/"+_page_number+"/persons"+_page_number+".mp3";
		$oga = "media/persons/"+_page_number+"/persons"+_page_number+".ogg";
	});

	//----------------------------------------------------------------------
	// Инициализация js-плейера	
	var player = new CirclePlayer("#jquery_jplayer_1",
	{
		mp3: $mp3,
		oga: $oga,
	}, {
		cssSelectorAncestor: "#cp_container_1",
		swfPath: "js",
		wmode: "window",
		supplied: "oga, mp3, m4a"
	});
	//----------------------------------------------------------------------*/
	
	$('.mini_player a.play_btn').click(function() {
		// новая координата top для js_player'а = текущее положение мини-плейера + высота блока story - высота js_player'a (или пол высоты)
		var top_jsp = $(this).parent().css('top').split('px')[0]*1 + $('.story').css('height').split('px')[0]*1 * $(this).parent().parent().data('tagcheck') - 85;

		$('#js_player').css('display', 'block');
		$('#js_player').animate({opacity: 0.0, top: top_jsp+'px'}, 1000, function() {
			$(this).animate({
				opacity: 1.0,
			}, 500);
		});
		$('#js_player .player_load').attr('href', FILE+'topics/media/'+$(this).data('media')+'/'+_media[$(this).data('media')]+'.mp3');
		
		var mp3 = FILE+'topics/media/'+$(this).data('media')+'/'+_media[$(this).data('media')]+'.mp3';
		var oga = FILE+'topics/media/'+$(this).data('media')+'/'+_media[$(this).data('media')]+'.ogg';
	
		$("#jquery_jplayer_1").jPlayer("destroy");
		player = new CirclePlayer("#jquery_jplayer_1",
		{
			mp3: mp3,
			oga: oga,
		}, {
			cssSelectorAncestor: "#cp_container_1",
			swfPath: "js",
			wmode: "window",
			supplied: "oga, mp3, m4a"
		});
		setTimeout(function() { $("#jquery_jplayer_1").jPlayer("play"); }, 1000);
		
	});
	
}); // document ready