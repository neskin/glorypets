<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'news/'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Добавить новую запись')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>news/newitem/" enctype="multipart/form-data">		
		<?inc_text("news_name", $this->input->post('news_name'), "need", "Имя")?>
		<?inc_select("news_catid", mak($category, 'newscategory_id', 'newscategory_name'), $this->input->post('news_catid'), array(0, 'No'), "", "Категория<br /><i>по умолчанию \"Нет\"</i>")?>
		<?inc_datepicker("news_time", $this->input->post('news_time'), "Дата")?>
		<?inc_textarea("news_description", $this->input->post('news_description'), "need", "Краткое описание")?>
		<?inc_editor("news_text", $this->input->post('news_text'), "Текст")?>
		<?inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>