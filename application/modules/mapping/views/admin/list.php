<!-- <div class="left_align_container start">
	<form name="sort" method="post" action="<?=HOSTADMIN?>glossarymapping/">
			<? //inc_select("groupid", mak($glossarymappinggroups, 'glossarymappinggroup_id', 'glossarymappinggroup_name'), $this->input->post('groupid'), null, "", "Сортировка по группе <br /> <i>(по-умолчанию: \"Администраторы\")</i>", "")?>
		<input type="hidden" name="submit" value="1" />
		<button onClick="javascript: document.forms['sort'].submit(); return false;" name="submit_form" value="1">Отсортировать</button><br /><br />
	</form>
</div>-->

<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'glossarymapping/newitem/'">Добавить&nbsp;запись</button>
</div>
<?inc_head(array(
	array('Название'),
	array('Статья', 150),
	array('Статус', 80),
	array('Удалить', 80),
))?>

<? $this->load->view('admin/elementlist', inc_list(
	$list,
	array(
		array('<a href="'.HOSTADMIN.'glossarymapping/edititem/%glossarymapping_id%/">%glossarymapping_name%</a>'),
		array('%glossary_name%', 150),
		array('<img 
			src="'.MEDIAURL.'images/admin/status_%glossarymapping_status%.png" 
			mysql_table="glossarymapping" 
			mysql_field_id="glossarymapping_id" 
			mysql_field_change="glossarymapping_status" 
			element_id="%glossarymapping_id%" 
			element_status="%glossarymapping_status%" 
			class="change_status status_id_%glossarymapping_id%" 
			/>', 80, 'center'),
		array('<img 
			src="'.MEDIAURL.'images/admin/delete.jpg" 
			mysql_table="glossarymapping" 
			mysql_field_id="glossarymapping_id" 
			mysql_field_pid="" 
			mysql_field_status="glossarymapping_status" 
			element_id="%glossarymapping_id%" 
			delete_url=""
			class="delete_element" 
			/>', 80, 'center'),
	),
	'glossarymapping_id',
	''
));?>
<div>
<br />
<!-- <div class="right_align_container">
	<button class="count_id" mysql_table="glossarymapping" mysql_field_change="glossarymapping_position" mysql_field_id="glossarymapping_id">Сохранить</button>
</div>-->