<?
	//-------------------------------------------------------------------------
	// ���������� GET ���������� ���� val1, val2, val3 etc. 
	// ���������� ���� ����������
	function get($in = 0){
		if(!is_numeric($in))
			return null;
		elseif(isset($_GET['val'.$in]))
			return es($_GET['val'.$in]);
		else
			return null;
	}
?>