<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'user/'">Вернуться&nbsp;к&nbsp;списку&nbsp;пользователей</button>
</div>
<?inc_head(array(
	array('Редактирование пользователя')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>user/edituser/<?=$user['user_id']?>/" enctype="multipart/form-data">
		<?inc_text("user_login", $user['user_login'], "need", "Логин")?>
		<?inc_text("user_password", $user['user_password'], "need", "Пароль")?>
		<?inc_text("user_email", $user['user_email'], "need", "E-mail")?>
		<?inc_select("user_usergroups[]", mak($usergroups, 'usergroup_id', 'usergroup_name'), ma($usergroups_s), null, "", "Группы<br /><i>по умолчанию \"Пользователи\"</i>", "multiple")?>
		<?inc_file("userinfo_image", "Аватар<br /><i>320px на 320px</i>", 1)?>
		<?inc_text("userinfo_name", $user['userinfo_name'], "", "Имя")?>
		<?inc_text("userinfo_address", $user['userinfo_address'], "", "Адрес")?>
		<?inc_text("userinfo_phone", $user['userinfo_phone'], "", "Телефон")?>
		<?inc_editor("userinfo_text", $user['userinfo_text'], "Дополнительная информация")?>
		<?inc_editor("userinfo_about", $user['userinfo_about'], "О пользователе")?>
		<?inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>