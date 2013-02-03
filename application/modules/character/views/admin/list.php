
<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'character/newitem/<?=$type?>/'">Добавить&nbsp;характеристику</button>
</div>
<?inc_head(array(
	array('Название'),
	array('Статус', 80),
	array('Удалить', 80),
))?>
<? $this->load->view('admin/elementlist', inc_list(
	$list,
	array(
		array('<a href="'.HOSTADMIN.'character/edititem/'.$type.'/%'.$type.'character_id%/">%'.$type.'character_name%</a>'),
		array('<img 
			src="'.MEDIAURL.'images/admin/status_%'.$type.'character_status%.png" 
			mysql_table="'.$type.'character" 
			mysql_field_id="'.$type.'character_id" 
			mysql_field_change="'.$type.'character_status" 
			element_id="%'.$type.'character_id%" 
			element_status="%'.$type.'character_status%" 
			class="change_status status_id_%'.$type.'character_id%" 
			/>', 80, 'center'),
		array('<img 
			src="'.MEDIAURL.'images/admin/delete.jpg" 
			mysql_table="'.$type.'character" 
			mysql_field_id="'.$type.'character_id" 
			mysql_field_pid="" 
			mysql_field_status="'.$type.'character_status" 
			element_id="%'.$type.'character_id%" 
			delete_url=""
			class="delete_element" 
			/>', 80, 'center'),
	),
	$type.'character_id',
	''
));?>
<div>
<br />
<!--<div class="right_align_container">
	<button class="count_id" mysql_table="<?=$type?>character" mysql_field_change="<?=$type?>character_position" mysql_field_id="<?=$type?>character_id">Сохранить</button>
</div>-->