<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'category/catlist/<?=$type?>/'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Редактировать запись')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>category/edititem/<?=$type?>/<?=$single[$type.'_category_id']?>/" enctype="multipart/form-data">
		<? inc_text($type."_category_name", $single[$type.'_category_name'], "need", "Имя")?>
		<? inc_textarea($type."_category_text", $single[$type.'_category_text'], "", "Описание")?>
		<? inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>