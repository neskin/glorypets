
<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'category/newitem/<?=$type?>/'">Добавить&nbsp;запись</button>
</div>
<?inc_head(array(
	array('Название'),
	array('Статус', 80),
	array('Удалить', 80),
))?>
<? $this->load->view('admin/elementlist', inc_list(
	$list,
	array(
		array('<a href="'.HOSTADMIN.'category/edititem/'.$type.'/%'.$type.'category_id%/">%'.$type.'category_name%</a>'),
		array('<img 
			src="'.MEDIAURL.'images/admin/status_%'.$type.'category_status%.png" 
			mysql_table="'.$type.'category" 
			mysql_field_id="'.$type.'category_id" 
			mysql_field_change="'.$type.'category_status" 
			element_id="%'.$type.'category_id%" 
			element_status="%'.$type.'category_status%" 
			class="change_status status_id_%'.$type.'category_id%" 
			/>', 80, 'center'),
		array('<img 
			src="'.MEDIAURL.'images/admin/delete.jpg" 
			mysql_table="'.$type.'category" 
			mysql_field_id="'.$type.'category_id" 
			mysql_field_pid="" 
			mysql_field_status="'.$type.'category_status" 
			element_id="%'.$type.'category_id%" 
			delete_url=""
			class="delete_element" 
			/>', 80, 'center'),
	),
	$type.'category_id',
	''
));?>
<div>
<br />
<!--<div class="right_align_container">
	<button class="count_id" mysql_table="<?=$type?>category" mysql_field_change="<?=$type?>category_position" mysql_field_id="<?=$type?>category_id">Сохранить</button>
</div>-->