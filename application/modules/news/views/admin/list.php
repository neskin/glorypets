<!-- <div class="left_align_container start">
	<form name="sort" method="post" action="<?=HOSTADMIN?>news/">
			<? //inc_select("groupid", mak($newsgroups, 'newsgroup_id', 'newsgroup_name'), $this->input->post('groupid'), null, "", "Сортировка по группе <br /> <i>(по-умолчанию: \"Администраторы\")</i>", "")?>
		<input type="hidden" name="submit" value="1" />
		<button onClick="javascript: document.forms['sort'].submit(); return false;" name="submit_form" value="1">Отсортировать</button><br /><br />
	</form>
</div>-->

<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'news/newitem/'">Добавить&nbsp;запись</button>
</div>
<?inc_head(array(
	array('Название'),
	array('Категория', 150),
	array('Дата', 200),
	array('Статус', 80),
	array('Удалить', 80),
))?>

<? $this->load->view('admin/elementlist', inc_list(
	$list,
	array(
		array('<a href="'.HOSTADMIN.'news/edititem/%news_id%/">%news_name%</a>'),
		array('%news_category_name%', 150),
		array('%news_time%', 200),
		array('<img 
			src="'.MEDIAURL.'images/admin/status_%news_status%.png" 
			mysql_table="news" 
			mysql_field_id="news_id" 
			mysql_field_change="news_status" 
			element_id="%news_id%" 
			element_status="%news_status%" 
			class="change_status status_id_%news_id%" 
			/>', 80, 'center'),
		array('<img 
			src="'.MEDIAURL.'images/admin/delete.jpg" 
			mysql_table="news" 
			mysql_field_id="news_id" 
			mysql_field_pid="" 
			mysql_field_status="news_status" 
			element_id="%news_id%" 
			delete_url=""
			class="delete_element" 
			/>', 80, 'center'),
	),
	'news_id',
	''
));?>
<div>
<br />
<!-- <div class="right_align_container">
	<button class="count_id" mysql_table="news" mysql_field_change="news_position" mysql_field_id="news_id">Сохранить</button>
</div>-->