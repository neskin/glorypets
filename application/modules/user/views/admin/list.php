<div class="left_align_container start">
	<form name="sort" method="post" action="<?=HOSTADMIN?>user/">
			<? inc_select("groupid", mak($usergroups, 'usergroup_id', 'usergroup_name'), $this->input->post('groupid'), null, "", "Сортировка по группе <br /> <i>(по-умолчанию: \"Администраторы\")</i>", "")?>
		<input type="hidden" name="submit" value="1" />
		<button onClick="javascript: document.forms['sort'].submit(); return false;" name="submit_form" value="1">Отсортировать</button><br /><br />
	</form>
</div>

<div class="right_align_container">
	<button onClick="javascript: window.location=HOST+'user/newuser/'">Добавить&nbsp;пользователя</button>
</div>
<?inc_head(array(
	array('Логин'),
	array('E-mail', 200),
	array('Группа', 150),
	array('Дата регистрации', 200),
	array('Статус', 80),
	array('Удалить', 80),
))?>

<? $this->load->view('admin/elementlist', inc_list(
	$userlist,
	array(
		array('<a href="'.HOSTADMIN.'user/edituser/%user_id%/">%user_login%</a>'),
		array('%user_email%', 200),
		array('%usergroup_name%', 150),
		array('%user_time_register%', 200),
		array('<img 
			src="'.MEDIAURL.'images/admin/status_%user_status%.png" 
			mysql_table="user" 
			mysql_field_id="user_id" 
			mysql_field_change="user_status" 
			element_id="%user_id%" 
			element_status="%user_status%" 
			class="change_status status_id_%user_id%" 
			/>', 80, 'center'),
		array('<img 
			src="'.MEDIAURL.'images/admin/delete.jpg" 
			mysql_table="user" 
			mysql_field_id="user_id" 
			mysql_field_pid="" 
			mysql_field_status="user_status" 
			element_id="%user_id%" 
			delete_url=""
			class="delete_element" 
			/>', 80, 'center'),
	),
	'user_id',
	''
));?>
<div>
<br />
<div class="right_align_container">
	<button class="count_id" mysql_table="user" mysql_field_change="user_position" mysql_field_id="user_id">Сохранить</button>
</div>