<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'mapping/'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Редактировать запись')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>mapping/edititem/<?=$single['glossarymapping_id']?>/" enctype="multipart/form-data">
		<? inc_select("glossarymapping_gid", mak($glossary, 'glossary_id', 'glossary_name'), $single['glossarymapping_gid'], array(0, 'No'), "", "Статья<br /><i>по умолчанию \"Нет\"</i>")?>
		<? inc_text("glossarymapping_name", $single['glossarymapping_name'], "need", "Описание<br /><i>(только для администратора)</i>")?>
		<? inc_textarea("glossarymapping_style", $single['glossarymapping_style'], "", "Координаты на картинке")?>
                <? inc_editor("glossarymapping_text", $single['glossarymapping_text'], "Текст")?>
		<? inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>