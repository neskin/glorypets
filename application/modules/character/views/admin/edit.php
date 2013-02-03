<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'character/charlist/<?=$type?>/'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Редактировать характеристику')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>character/edititem/<?=$type?>/<?=$single[$type.'character_id']?>/" enctype="multipart/form-data">
		<? inc_text($type."character_name", $single[$type.'character_name'], "need", "Имя")?>
		<? inc_textarea($type."character_text", $single[$type.'character_text'], "", "Описание")?>
		<? inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>