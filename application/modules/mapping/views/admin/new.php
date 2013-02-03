<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'glossarymapping/'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Добавить новую запись')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>glossarymapping/newitem/" enctype="multipart/form-data">		
		<?inc_text("glossarymapping_name", $this->input->post('glossarymapping_name'), "need", "Имя")?>
		<?inc_select("glossarymapping_gid", mak($glossary, 'glossary_id', 'glossary_name'), $this->input->post('glossarymapping_gid'), array(0, 'No'), "", "Статья<br /><i>по умолчанию \"Нет\"</i>")?>
		<?inc_textarea("glossarymapping_style", $this->input->post('glossarymapping_style'), "need", "Координаты на картинке")?>
		<?inc_editor("glossarymapping_text", $this->input->post('glossarymapping_text'), "Текст")?>
		<?inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>