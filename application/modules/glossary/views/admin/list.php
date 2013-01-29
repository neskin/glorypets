<!-- <div class="left_align_container start">
	<form name="sort" method="post" action="<?=HOSTADMIN?>glossary/">
			<? //inc_select("groupid", mak($glossarygroups, 'glossarygroup_id', 'glossarygroup_name'), $this->input->post('groupid'), null, "", "Сортировка по группе <br /> <i>(по-умолчанию: \"Администраторы\")</i>", "")?>
		<input type="hidden" name="submit" value="1" />
		<button onClick="javascript: document.forms['sort'].submit(); return false;" name="submit_form" value="1">Отсортировать</button><br /><br />
	</form>
</div>-->

<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'glossary/newitem/'">Добавить&nbsp;запись</button>
</div>
<?inc_head(array(
	array('Название'),
	//array('Категория', 150),
	array('Статус', 80),
	array('Удалить', 80),
))?>

<? $this->load->view('admin/elementlist', inc_list(
	$list,
	array(
		array('<a href="'.HOSTADMIN.'glossary/edititem/%glossary_id%/">%glossary_name%</a>'),
		//array('%glossary_category_name%', 150),
		array('<img 
			src="'.MEDIAURL.'images/admin/status_%glossary_status%.png" 
			mysql_table="glossary" 
			mysql_field_id="glossary_id" 
			mysql_field_change="glossary_status" 
			element_id="%glossary_id%" 
			element_status="%glossary_status%" 
			class="change_status status_id_%glossary_id%" 
			/>', 80, 'center'),
		array('<img 
			src="'.MEDIAURL.'images/admin/delete.jpg" 
			mysql_table="glossary" 
			mysql_field_id="glossary_id" 
			mysql_field_pid="" 
			mysql_field_status="glossary_status" 
			element_id="%glossary_id%" 
			delete_url=""
			class="delete_element" 
			/>', 80, 'center'),
	),
	'glossary_id',
	''
));?>
<div>
<br />
<!-- <div class="right_align_container">
	<button class="count_id" mysql_table="glossary" mysql_field_change="glossary_position" mysql_field_id="glossary_id">Сохранить</button>
</div>-->