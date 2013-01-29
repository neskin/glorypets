$(document).ready(function(){
	$('.save_when_change').change(function() {
		var el = $(this);
		var prise_name = '';
		if(el.hasClass('taxi_left')) prise_name = 'taxi_left';
		else if(el.hasClass('buss_left')) prise_name = 'buss_left';
		else if(el.hasClass('beer_left')) prise_name = 'beer_left';
				
		send_post(HOST+'prise/save_cgange/', 'value='+el.val()+'&name='+prise_name, '')
	});
});