<?php
	//--------------- НЕ НУЖНА В CI ----------------------------------------------------------
	// Функция возвращающая $_GET и $_POST запросы
	function p($id, $e = true){
		$res = null;
		if($e)
			$ek = 'es';
		else
			$ek = 'return';
	
		if(isset($_POST[$id]))
			$res = $ek($_POST[$id]);
		elseif(isset($_GET[$id]))
			$res = $ek($_GET[$id]);
			
		return $res;	
	}
	//-------------------------------------------------------------------------
	// Функция экранирующая спецсимволы
	function es($val){
		if(!$val)
			return null;
			
		if(!is_array($val))
			//return addslashes(preg_replace("#\"#msi", "&quot;", $val));
			return addslashes($val);
		
		foreach($val as $k=>$v){
			if(!is_array($v))
				//$val[$k] = addslashes(preg_replace("#\"#msi", "&quot;", $v));
				$val[$k] = addslashes($v);
			else
				$val[$k] = es($v);
		}
		
		return $val;
	}
	//-------------------------------------------------------------------------
	function quot($val){
		return preg_replace("#\"#msi", "&quot;", $val);
	}
	//-------------------------------------------------------------------------
	// Функция валидации e-mail
	// Возвращает true если e-mail корректен и false если нет
	function vm($mail){
		if (preg_match("/^(?:[a-z0-9\.]+(?:[-_]?[a-z0-9\.]+)?@[a-z0-9]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail))
			return true;
		else
			return false;
	}
	/*/--------------------- НЕ НУЖНА В CI ---------------------------------------------------------
	// Получение переменных переданых через $_GET
	// возвращаются только переменные с именем $val1, $val2, $val3 etc. 
	// возвращает массив
	function get_site_vars(){
		$do = true;
		$i = 0;
		$res = array();
		while($do == true){
			$i += 1;
			if(isset($_GET['val'.$i]))
				$res[$i] = es($_GET['val'.$i]);
			else
				$do = false;
		}
		
		return $res;
	}*/
	/*/-------------------------- НЕ НУЖНА В CI -----------------------------------------------
	// возвращает GET переменную типа val1, val2, val3 etc. 
	// возвращает одну переменную
	function get($in = 0){
		if(!is_numeric($in))
			return null;
		elseif(isset($_GET['val'.$in]))
			return es($_GET['val'.$in]);
		else
			return null;
	}*/
	//-------------------------------------------------------------------------
	// возвращает или устанавливает текущий язык проекта
	function cl($val = false){
		if(empty($val) && !empty($_SESSION['current_lang']))
			return $_SESSION['current_lang'];
		elseif(empty($val)){
			$_SESSION['current_lang'] = $GLOBALS['langs_list'][0];
			return $_SESSION['current_lang'];
		}	
		elseif($val != false && in_array($val, $GLOBALS['langs_list'])){
			$_SESSION['current_lang'] = $val;
			return $_SESSION['current_lang'];
		}
		else{
			$_SESSION['current_lang'] = $GLOBALS['langs_list'][0];
			return $_SESSION['current_lang'];
		}
	}
	//-------------------------------------------------------------------------
	// Сравнение 2-х переменных, и возвращение результата
	// Если 2-я переменная является массивом то идет сравнение 
	function se($val1, $val2, $ret1 = 'active', $ret2 = ''){
		if(is_array($val2)){
			if(in_array($val1, $val2))
				return $ret1;
			else
				return $ret2;
		}
		else{
			if($val1 == $val2)
				return $ret1;
			else
				return $ret2;
		}	
	}
	/*/----------------------------- НЕ НУЖНА В CI --------------------------------------------
	// Переход на страницу
	function go_to($to = null){
		if($to == null && !empty($_SESSION['go_back_page']))
			$to = $_SESSION['go_back_page'];
		elseif($to == null)
			$to = HOST;

		header("location: ".$to);
		die();
	}*/
	//-------------------------------------------------------------------------
	// Возвращает одномерный массив с ключами $key, 
	// если key == null то будет возвращен одномерный массив содержащий все элементы исходного массива
	function ma($ar, $key = null, $res = array(), &$i = 0){
		if(empty($ar) || !is_array($ar))
			return $res;
			
		foreach($ar as $k=>$v){
			if(is_array($v))
				$res = ma($v, $key, $res, $i);
	
			elseif(($key == null || $k == $key) && !is_array($v)){
				$res[$i] = $v;
				$i ++;
			}	
		}
		
		return $res;
	}
	//-------------------------------------------------------------------------
	// Функция возвращает одномерный массив с $key=>$value
	// То есть передаем функции массив данных. находит пары key=>value. 
	// причем key=>value не должны быть массивами
	function mak($a, $k = null, $v = null, $res = array()){	
		if(!is_array($a) || empty($a))
			return $res;
						
		if(isset($a[$k]) && isset($a[$v]) && !is_array($a[$k]) && !is_array($a[$v])){
			$res[] = array('key'=>$a[$k], 'val'=>$a[$v]);
			unset($a[$k]);
			unset($a[$v]);
		}

		foreach($a as $val){
			if(is_array($val))
				$res = mak($val, $k, $v, $res);
		}
		
		return $res;
	}
	//-------------------------------------------------------------------------
	// Функции передается 3 массива. 
	// $f  - массив модержащий ключи переменных которые будут доставатся из post
	// $dv - массив содержащий ключ значение, и если возвращается пустая переменная то будет доставатся значение из dv
	// $n  - массив содержащий ключи переменных которые надо проверить на наличие
	function mafg($f, $dv = array(), $n = array()){
		if(empty($f))
			return false;
			
		foreach($f as $v){
			$r[$v] = p($v);
			if($r[$v] == null && isset($dv[$v]))
				$r[$v] = $dv[$v];
		}
		
		if(empty($n))
			return $r;
			
		foreach($n as $v){
			if(!isset($r[$v]) || empty($r[$v]))
				return false;
		}
		
		return $r;
	}
	//-------------------------------------------------------------------------
	// Функция принимает и отдает массив добавляя к началу и концу каждого элемента символ $ekr
	function ekr($ar, $ekr){
		if(empty($ar))	
			return $ar;
			
		foreach($ar as $k=>$v){
			if(!is_array($v))
				$ar[$k] = $ekr.$v.$ekr;
			else	
				$ar[$k] = ekr($ar[$k], $ekr);
		}
		
		return $ar;
	}
	//-------------------------------------------------------------------------
	// Функция принимает одномерный массив и сливает его ключ со значением, 
	// слияние происходит через $del, по умолчанию ' = '
	// если передается mod = 1, то ключ экранируется ` а значение '
	// функция предназначена для работы с update
	function sp_k_v($ar, $del = ' = ', $mod = 1){
		if(empty($ar) || !is_array($ar))
			return $ar;
			
		foreach($ar as $k=>$v){
			if($mod == 1){
				$k = "`".$k."`";
				$v = "'".$v."'";
			}
			$r[] = $k.$del.$v;
		}
		
		return $r;
	}
	//-------------------------------------------------------------------------
	// Функция инициализирует библиотеку из папки shared/php/lib/
	function init_lib($lib){
		if(is_file(SHARED_DIR.'php/lib/'.$lib.'.php'))
			require_once(SHARED_DIR.'php/lib/'.$lib.'.php');
	}
	//-------------------------------------------------------------------------
	// функция переводит текст в латиницу
	// Если $mod = 1 то убирает все символы не допустимые в адресной строке
	function tt($text, $mod = 1){
		$rep = array(
			"А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
			"Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
			"Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
			"О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
			"У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
			"Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
			"Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
			"і"=>"i","І"=>"I","є"=>"e","Є"=>"E", "é"=>"e", "É"=>"E"
		);
		$text = strtr($text,$rep);
		if($mod == 1){
			$text = preg_replace("#[ ]#msi", "_", $text);
			$text = preg_replace("#[^A-Z0-9_-]#msi", "", $text);
		}
		
		return $text;
	}
	//-------------------------------------------------------------------------
	// Функция преобразовывает текст из textarea, убирая все html теги и заменяя \n на <br />
	function n_to_br($text){
		return strip_tags(preg_replace("#\r\n#msi", "<br>", $text), "<br>");
	}
	//-------------------------------------------------------------------------
	// Функция делает текст для textarea, заменяет все <br /> на \n
	function br_to_n($text){
		return preg_replace("#<br>#msi", "\r\n", $text);
	}
	//-------------------------------------------------------------------------
	// Функция заменяет пробелы на неразрывные пробелы
	function nbsp($text){
		return preg_replace("# #msi", "&nbsp;", $text);
	}
	/*/--------------------------- НЕ НУЖНА В CI ----------------------------------------------
	// Подключение из lib шаблона
	function show_lib_tpl($tpl_name, $vars){
		$tpl_dir = PROJECTDIR.'lib/tpl/';
			
		if(empty($tpl_name))
			return false;
				
		if(is_file($tpl_dir.$tpl_name))
			require($tpl_dir.$tpl_name);
	}*/
	
	/*/---------------------------------- НЕ НУЖНА В CI ---------------------------------------
	// возвращает GET переменные в виде строки. возвращаются все переменные после ? вместе с знаком ?
	// 21.09.2011
	function get_list(){
		$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$url = explode('?', $url);
		if(!empty($url[1])) return '?'.$url[1];
		
		return null;
	}*/
	
	//-------------------------------------------------------------------------
	// Определяет существование файла
	// 06.10.2011
	function f_exist($link)	{
		if(is_file(UPLOAD_FILE_DIR.$link))
			$link = UPLOAD_FILE_URL.$link;
		else
			$link = UPLOAD_FILE_URL.'imgs/default.jpg';
		
		return $link;
	}
	
	//-------------------------------------------------------------------------
	// Проверяет существование модуля
	// 17.10.2011
	function modul_exist($modul) {
 		if(is_dir(PROJECT_DIR.'moduls/'.$modul.'/'))
 			return true;
 		else 
 			return false;
	}
	
		
	//-------------------------------------------------------------------------
	// Функция преобразовывает дату
	// Если передана дата формата дд-мм-гггг то будет преобразовано в метку времени 
	// Если переданная дата = 0 то будет возвращена текущая метка времени
	// Если переданна дата в формате unix метки времени то вернется дата в формате дд-мм-гггг 
	// Если $minsec = true, то дата вернется с часами, минутами, секундами
	function transform_time($d, $minsec = false) {
		if($d == 0 || empty($d))
			return time();
		elseif(is_numeric($d)) {
			if($minsec == false)
				return date("d/m/Y", $d);
			else	
				return date("d/m/Y - H:i:s", $d);
		} else {
			$d = explode("/", $d);
			$d = mktime(12, 0, 0, $d[1], $d[0], $d[2]);
			return $d;
		}
	}
	
	//-------------------------------------------------------------------------
	// Проходится рекурсивно по массиву и применяет к полю $f или полям массива $f функцию преобразования даты
	function tt_in_a($a, $f, $minsec = false) {
		if(!is_array($a))
			return $a;
		
		if(!is_array($f)) {
			foreach($a as $k=>$v) {
				if($k==$f && !is_array($v))
					$a[$k] = transform_time($a[$k], $minsec);
				elseif(is_array($v))
					$a[$k] = tt_in_a($a[$k], $f, $minsec);
			}
		} elseif(is_array($f)) {
			foreach($f as $t) {
				foreach($a as $k=>$v) {
					if($k==$t && !is_array($v))
						$a[$k] = transform_time($a[$k], $minsec);
					elseif(is_array($v))
						$a[$k] = tt_in_a($a[$k], $t, $minsec);
				}
			}
		}
		return $a;
	}
	//-------------------------------------------------------------------------
	