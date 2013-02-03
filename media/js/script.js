$(document).ready(function() {	

	$(".vote").live("click", function(){
                if($.cookie('user_id') != '') {
                    send_post(HOST+CL+'/news/newsrate/', {'id': $(this).data('id'), 'rate':$(this).data('rate')}, 'newsrate_callback(data)');
                } else {
                    rate_popup_show();
                }
                
	});
        
        
        $('#search_by_letter a').live('click', function() {
            var value = $(this).html();
            if(value == null || value == undefined)
                value = 0;
            $("#letter_search").val(value);
            document.forms['glossary_search'].submit();
        });
});

// --------------------------------------------------------------------------->
// 
function gletter_search(obj){
	
       // alert(obj);
	//var value = $("#search_by_letter a").data('value');
        alert(value);
        
        //
}



// --------------------------------------------------------------------------->
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


// РАБОТА С POP_UPом --------------------------------------------------------->
//
function close_pop_up(){
	$('#popUpContainer').html('');
	$("#popUp").hide(200, function() {
		$("#darkFon").hide('slide', {direction: 'right'}, 300);
	});
}

function rate_popup_show() {
    popup_show('rate');
}

function popup_callback(data) {
	$('#popUpContainer').html(data);
}

function popup_show(msg) {
        $("#popup").fadeIn(300, function() {
            if(msg == 'rate') {
                msg = 'Авторизуйтесь чтобы прголосовать!';
                $("#popup_text").html(msg);
            }
        });
        
}



// Callback-functions -------------------------------------------------------->
function newsrate_callback(data) {
    if(data != 0) {
        $("#votenews"+data+" .vote").removeClass('vote');
        var votes = $("#votenews"+data+" .vote_title span").html()*1;
        $("#votenews"+data+" .vote_title span").html(votes+1);
    } else {
        rate_popup_show('rate');
    }
}


// ------------------------------------------------------------------------------- */