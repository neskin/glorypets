<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'news/'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Редактировать запись')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>news/edititem/<?=$single['news_id']?>/" enctype="multipart/form-data">
		<? inc_text("news_name", $single['news_name'], "need", "Имя")?>
		<? inc_select("news_catid", mak($category, 'news_category_id', 'news_category_name'), $single['news_catid'], array(0, 'No'), "", "Категория<br /><i>по умолчанию \"Нет\"</i>")?>
		<? inc_datepicker("news_time", transform_time($single['news_time']), "Дата")?>
		<? inc_textarea("news_description", $single['news_description'], "need", "Краткое описание")?>
		<? inc_editor("news_text", $single['news_text'], "Текст")?>
		<? inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>