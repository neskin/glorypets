<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'user/'">Вернуться&nbsp;к&nbsp;списку&nbsp;пользователей</button>
</div>
<?inc_head(array(
	array('Добавление нового пользователя')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>user/newuser/" enctype="multipart/form-data">
		<?inc_text("user_login", $this->input->post('user_login'), "need", "Логин")?>
		<?inc_text("user_password", $this->input->post('user_password'), "need", "Пароль")?>
		<?inc_text("user_email", $this->input->post('user_email'), "need", "E-mail")?>
		<?inc_select("user_usergroups[]", mak($usergroups, 'usergroup_id', 'usergroup_name'), $this->input->post('user_usergroups'), null, "", "Группы<br /><i>по умолчанию \"Пользователи\"</i>", "multiple")?>
		<?inc_file("userinfo_image", "Аватар<br /><i>320px на 320px</i>", 1)?>
		<?inc_text("userinfo_name", $this->input->post('userinfo_name'), "", "Имя")?>
		<?inc_text("userinfo_address", $this->input->post('userinfo_address'), "", "Адрес")?>
		<?inc_text("userinfo_phone", $this->input->post('userinfo_phone'), "", "Телефон")?>
		<?inc_editor("userinfo_text", $this->input->post('userinfo_text'), "Дополнительная информация")?>
		<?inc_editor("userinfo_about", $this->input->post('userinfo_about'), "О пользователе")?>
		<?inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>