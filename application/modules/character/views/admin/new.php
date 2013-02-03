<div class="right_align_container start">
	<button onClick="javascript: window.location=HOST+'character/charlist/<?=$type?>'">Вернуться&nbsp;к&nbsp;списку</button>
</div>
<?inc_head(array(
	array('Добавить новую характеристику')
))?>
<div class="white_container">
	<form method="post" name="form" action="<?=HOSTADMIN?>character/newitem/<?=$type?>/" enctype="multipart/form-data">		
		<?inc_text($type."character_name", $this->input->post($type.'character_name'), "need", "Название")?>
		<?inc_textarea($type."character_text", $this->input->post($type.'character_text'), "", "Описание")?>
		<?inc_btn("submit", "Сохранить", "submit_form", 1)?>
	</form>
</div>