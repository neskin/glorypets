<?
//-------------------------------------------------------------------------
	// ����������� js � ����� �������
	function inc_js($js){
		if(empty($js))
			return false;
		echo '<script type="text/javascript" src="'.HOST.'media/js/'.$js.'.js"></script>
';
	}	
	//-------------------------------------------------------------------------	
	// ����������� css � ����� �������
	function inc_css($css){
		if(empty($css))
			return false;
		echo '<link rel="stylesheet" type="text/css" href="'.HOST.'media/css/'.$css.'.css" />
';
	}
?>