// Функции Прелоадера

function preloader_die() {
	setTimeout(function() { 
		$('#preloaderbg').fadeOut(250, function() {
			clearInterval(pbPos); 
		});
	}, 1000);	
}