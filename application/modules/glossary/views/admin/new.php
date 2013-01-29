<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'glossary/'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Добавить новую запись')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>glossary/newitem/" enctype="multipart/form-data">		
		<?inc_text("glossary_name", $this->input->post('glossary_name'), "need", "Имя")?>
		<?//inc_select("glossary_catid", mak($category, 'glossary_category_id', 'glossary_category_name'), $this->input->post('glossary_catid'), array(0, 'No'), "", "Категория<br /><i>по умолчанию \"Нет\"</i>")?>
		<?inc_textarea("glossary_description", $this->input->post('glossary_description'), "need", "Краткое описание")?>
		<?inc_editor("glossary_text", $this->input->post('glossary_text'), "Текст")?>
		<?inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>