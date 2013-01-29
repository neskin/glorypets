
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
		array('<a href="'.HOSTADMIN.'category/edititem/'.$type.'/%'.$type.'_category_id%/">%'.$type.'_category_name%</a>'),
		array('<img 
			src="'.MEDIAURL.'images/admin/status_%'.$type.'_category_status%.png" 
			mysql_table="'.$type.'_category" 
			mysql_field_id="'.$type.'_category_id" 
			mysql_field_change="'.$type.'_category_status" 
			element_id="%'.$type.'_category_id%" 
			element_status="%'.$type.'_category_status%" 
			class="change_status status_id_%'.$type.'_category_id%" 
			/>', 80, 'center'),
		array('<img 
			src="'.MEDIAURL.'images/admin/delete.jpg" 
			mysql_table="'.$type.'_category" 
			mysql_field_id="'.$type.'_category_id" 
			mysql_field_pid="" 
			mysql_field_status="'.$type.'_category_status" 
			element_id="%'.$type.'_category_id%" 
			delete_url=""
			class="delete_element" 
			/>', 80, 'center'),
	),
	$type.'_category_id',
	''
));?>
<div>
<br />
<!--<div class="right_align_container">
	<button class="count_id" mysql_table="category" mysql_field_change="category_position" mysql_field_id="category_id">Сохранить</button>
</div>-->