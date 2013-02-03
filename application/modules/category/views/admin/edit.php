<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'category/catlist/<?=$type?>/'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Редактировать запись')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>category/edititem/<?=$type?>/<?=$single[$type.'category_id']?>/" enctype="multipart/form-data">
		<? inc_text($type."category_name", $single[$type.'category_name'], "need", "Имя")?>
		<? inc_textarea($type."category_text", $single[$type.'category_text'], "", "Описание")?>
		<? inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>