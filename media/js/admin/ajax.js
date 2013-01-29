var del_div;

$(document).ready(function(){
	//------------------------------------------------------------------------------
	// Подсчет элементов и отсылка на сервер их новой позиции
	$(".count_id").click(function(){
		var table        = $(this).attr('mysql_table');
		var field_change = $(this).attr('mysql_field_change');
		var field_id     = $(this).attr('mysql_field_id');
		var ids          = new Array();
		
		$("ul.sortable").children("li").each(function(){
			if($(this).attr('li_id') != undefined)
				ids[ids.length] = $(this).attr('li_id');
		});
		
		if(!empty(ids))
			send_post(HOST+'ajax/save_position/', {'table':table, 'field_change':field_change, 'field_id':field_id, 'ids':ids}, 'change_position_result(data)');
	});
	//------------------------------------------------------------------------------
	// Смена статуса элементов
	$(".change_status").click(function(){
		var table        = $(this).attr('mysql_table');
		var field_change = $(this).attr('mysql_field_change');
		var field_id     = $(this).attr('mysql_field_id');
		var id           = $(this).attr('element_id')
		var status       = $(this).attr('element_status')
		
		send_post(HOST+'ajax/change_status/', {'table':table, 'field_change':field_change, 'field_id':field_id, 'id':id, 'status':status}, 'change_status_result(data, "'+id+'", "'+status+'")');
	});
	//------------------------------------------------------------------------------
	// Удаление элемента
	$(".delete_element").click(function(){
		if (!confirm('Элемент будет удален. Вы уверены?')) 
			return false;
		var table        = $(this).attr('mysql_table');
		var field_id     = $(this).attr('mysql_field_id');
		var field_pid    = $(this).attr('mysql_field_pid');
		var field_status = $(this).attr('mysql_field_status');
		var id           = $(this).attr('element_id');
		var url          = $(this).attr('delete_url');
		
		if(empty(url))
			url = HOST+'ajax/delete_element/';
		else
			url = HOST+url;
		
		send_post(url, {'table':table, 'field_id':field_id, 'field_pid':field_pid, 'field_status':field_status, 'id':id}, 'delete_element_result(data, "'+id+'")');
	});
	//------------------------------------------------------------------------------
	// Удаление файла из списка - 01.03.2012
	$(".delete_selected_file").click(function(){
		var id  = $(this).attr('mysql_id');
		var url = $(this).attr('url');
		del_div = $(this).parent('div');
		
		
		send_post(url, 'id='+id, 'delete_selected_file_result(data)');
	});
	//------------------------------------------------------------------------------
});







//------------------------------------------------------------------------------
function change_position_result(data){
	if(data == 1) alert("Успешно сохранено"); 
	else alert("Ошибка! Позиции элементов не обновлены");
}
//------------------------------------------------------------------------------
function change_status_result(data, id, status){
	if(data == 1) {
		if(status == 1)
			status = 0;
		else
			status = 1;
		
		$(".status_id_"+id).attr('element_status', status);
		$(".status_id_"+id).attr('src', SKIN_URL+'images/admin/status_'+status+'.png');
	} else 
		alert("Ошибка! Статус не обновлен");
}
//------------------------------------------------------------------------------
function delete_element_result(data, id){
	if(data == 1)
		$(".li_num_"+id).remove();
}
//------------------------------------------------------------------------------
function delete_selected_file_result(data){
	if(data == 1)
		del_div.remove();
}
//------------------------------------------------------------------------------