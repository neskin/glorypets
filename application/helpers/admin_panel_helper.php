<?php
	//-------------------------------------------------------------------------
	// Строит меню в админке
	function admin_menu(){
		$menu_ar = array(
			array('Администраторы', HOST.'admin/', array()),
			array('Персоны', HOST.'persons/', array()),
			array('Темы', HOST.'topics/', array()),
		);
		return $menu_ar;
		//$menu_ar = $this->config->item('leftside_menu');
		//$this->load->view('admin/leftmenu', $menu_ar);

	}
	
	//-------------------------------------------------------------------------
	// Возвращает текстовое поле <input type="text">
	function inc_text($name, $value = "", $class = "", $text = ""){
		echo '<table class="input_text_field">
		';
		echo '	<tr>
		';
		echo '		<td class="input_text_field_descr">'.$text.'</td>
		';
		echo '		<td class="input_text_field_field"><input type="text" name="'.$name.'" value="'.$value.'" class="'.$class.'" /></td>
		';
		echo '	</tr>
		';
		echo '	<tr>
		';
		echo '		<td class="input_text_field_descr"></td>
		';
		echo '		<td class=""><div class="ci_error_msg">'.form_error($name).'</div></td>
		';
		echo '	</tr>
		';
		echo '</table>
		';
	}
	//-------------------------------------------------------------------------
	// Возвращает select поле <select></select>
	function inc_select($name, $array = array(), $selected = null, $default = null, $class = "", $text = "", $option = ""){
		echo '<table class="input_text_field '.$class.'">
		';
		echo ' <tr>
		';
		echo '  <td class="input_text_field_descr">'.$text.'</td>
		';
		echo '  <td class="input_text_field_select">
		';
		echo '   <SELECT name="'.$name.'" class="chosen" '.$option.'>
		';
		if(!empty($array)) {
			if($default != null)
				echo '    <OPTION value="'.nbsp($default[0]).'">'.nbsp($default[1]).'</OPTION>
 				';
   
  			foreach($array as $v){
				echo '    <OPTION value="'.$v['key'].'"'.se($v['key'], $selected, ' SELECTED').'>'.nbsp($v['val']).'</OPTION>
				';
			} 
		}
		echo '   </SELECT>
		';
		echo '  </td>
		';
		echo ' </tr>
		';
		echo '</table>
		';
	}
	//-------------------------------------------------------------------------
	// Инициализация редактора
	function init_editor(){
		echo '
<script src="'.EDITORURL.'js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
<script src="'.EDITORURL.'js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="'.EDITORURL.'css/elrte.min.css" type="text/css" media="screen" charset="utf-8">

<script src="'.EDITORURL.'js/elfinder.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="'.EDITORURL.'css/elfinder.css" type="text/css" media="screen" charset="utf-8">
<script src="'.EDITORURL.'js/i18n/elfinder.ru.js" type="text/javascript" charset="utf-8"></script>
';
		$GLOBALS['editor_init'] = 1;
	}
	//-------------------------------------------------------------------------
	// Подключение редактора
	function inc_editor($name, $value = "", $text = ""){
		if(!isset($GLOBALS['editor_init']) || $GLOBALS['editor_init'] != 1)
			init_editor();
			
		$id = "editor".rand(1, 1000);
		echo '<div class="textarea_descr">'.$text.'</div>';
		echo '<textarea name="'.$name.'" id="'.$id.'"></textarea>';
		echo '<div class="tw_ot"></div>';
		echo "
<script type=\"text/javascript\" charset=\"utf-8\">
	$(document).ready(function() {
		var opts = {
			lang         : 'ru',
			styleWithCSS : false,
			height       : 400,
			toolbar      : 'maxi',
			fmOpen : function(callback) {
				$('<div id=\"myelfinder\" />').elfinder({
					url : '".EDITORURL."connectors/php/connector.php',
					lang : 'ru',
					dialog : { width : 900, modal : true, title : 'Files' },
					closeOnEditorCallback : true,
					editorCallback : callback
				})
			}
		};
		$('#".$id."').elrte(opts);
		$('#".$id."').elrte('val', '".preg_replace("#\r\n#", "", addslashes($value))."');
	});
</script>";
	}
	//-------------------------------------------------------------------------
	// Возвращает кнопку
	function inc_btn($name, $text, $class = '', $value = ''){
		echo '<div class="save_btn_container"><button name="'.$name.'" value="'.$value.'" class="'.$class.'">'.$text.'</button></div>
';
	}
	//-------------------------------------------------------------------------
	// Возвращает шапку страницы с содержанием
	function inc_head($ar){
		if(!is_array($ar) || empty($ar))
			return false;
			
		echo '<table class="heade_table">
';
		echo '	<tr>
		<td width="20"></td>
';
		foreach($ar as $v){
			if(isset($v[1]) && is_numeric($v[1])) $w = ' width="'.$v[1].'"';
			else $w = '';
			echo '		<td'.$w.'>
';
			echo '			'.$v[0].'
';
			echo '		</td>
';
		}
		echo '		<td width="20"></td>
	</tr>
';
		echo '</table>
';
	}
	//-------------------------------------------------------------------------
	// Функция строит список элементов
	function inc_list($ar, $el, $li_id, $cl = ''){
		if(empty($ar) || empty($el))
			return false;
			
		//show_lib_tpl('element_list.php', array('ar'=>$ar, 'el'=>$el, 'li_id'=>$li_id, 'cl'=>$cl));
		//preg_match_all("#%([a-zA-Z_]{1,100})%#", $el[0][0], $m);
		return array('ar'=>$ar, 'el'=>$el, 'li_id'=>$li_id, 'cl'=>$cl);		
	}
	//-------------------------------------------------------------------------
	// Подключение datepicker
	function inc_datepicker($name, $value = '', $text, $id = 'datepicker'){
		echo 
		'<table class="input_text_field">
			<tr>
				<td class="input_text_field_descr">'.$text.'</td>
				<td class="input_text_field_field">
					<input id="'.$id.'" type="text" name="'.$name.'" value="'.$value.'">
				</td>
			</tr>
		</table>
		<script type="text/javascript">
		$(function() {
			$( "#'.$id.'" ).datepicker({ dateFormat: "dd/mm/yy" });
		});
		</script>';
				
		//show_lib_tpl('datepicker.php', array('name'=>$name, 'text'=>$text, 'value'=>$value, 'id'=>$id)); 
	}
	//-------------------------------------------------------------------------
	// Возвращает textarea
	function inc_textarea($name, $value = '', $class = '', $text){
		echo '<table class="input_text_field">
			<tr>
				<td class="input_text_field_descr">'.$text.'</td>
				<td class="input_text_field_textarea">
					<textarea name="'.$name.'"'.$class.'>'.$value.'</textarea>
				</td>
			</tr>
		</table>';
		
		//show_lib_tpl('textarea.php', array('name'=>$name, 'text'=>$text, 'value'=>$value, 'class'=>' class="'.$class.'"'));	
	}
	
	//-------------------------------------------------------------------------
	/* Возвращает поле для загрузки файлов
	Передаются поля:
		$name - поля
		$text - описание
		$limit - кол-во загружаемых файлов
		$value - файлы которые были загружены, структура
			$value = array(
				$dir => Директория в которой лежат файлы
				$files => array(
					array($file_name, $file_id),
					array($file_name, $file_id),
					array($file_name, $file_id),
				)
			);
		$url - url на который отправляется запрос удаления файла	
	*/
	function inc_file($name, $text, $limit = 1, $value = array(), $url = "", $index = 1){
		//show_lib_tpl('file.php', array('name'=>$name, 'text'=>$text, 'limit'=>$limit, 'value'=>$value, 'url'=>$url, 'index'=>$index));
	}

	//-------------------------------------------------------------------------
	function rc(){
		echo '</td>
<td id="right_column">
';
	}
	//-------------------------------------------------------------------------
	// Проходится рекурсивно по массиву и применяет к полю $f функцию преобразования даты
	/*function tt_in_a($a, $f){
		if(!is_array($a))
			return $a;
			
		foreach($a as $k=>$v){
			if($k==$f && !is_array($v))
				$a[$k] = transform_time($a[$k]);
			elseif(is_array($v))
				$a[$k] = tt_in_a($a[$k], $f);
		}
		
		return $a;
	}*/
	
	//-------------------------------------------------------------------------
	// функция проходится по массиву $ar и строит строку для записи в БД
	// 7.09.2011
	function ar_id_for_ins($ar, $id){
		foreach($ar as $v){
			$res[] = "('$id', '$v')";
		}
		return implode(", ", $res);
	}
	//-------------------------------------------------------------------------
	// Функция получает массив $files, и возвращает или false если нету ни одного переданного файла
	// или массив отсортированых файлов приведенных к единому виду
	// 7.09.2011
	function struct_files($f){
		$res = array();
		if(empty($f))
			return array();
		foreach($f['error'] as $k=>$v){
			if($v == 0){
				$res[$k]['name']     = $f['name'][$k];
				$res[$k]['type']     = $f['type'][$k];
				$res[$k]['tmp_name'] = $f['tmp_name'][$k];
				$res[$k]['size']     = $f['size'][$k];
				$res[$k]['error']    = 0;
			}
		}
		return $res;
	}
	//-------------------------------------------------------------------------	
?>