<?
	//-------------------------------------------------------------------------
	// возвращает GET переменную типа val1, val2, val3 etc. 
	// возвращает одну переменную
	function get($in = 0){
		if(!is_numeric($in))
			return null;
		elseif(isset($_GET['val'.$in]))
			return es($_GET['val'.$in]);
		else
			return null;
	}
?>