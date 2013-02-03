<!DOCTYPE >
<html> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>{page_title}</title>
		<link rel="stylesheet" type="text/css" href="<?=MEDIAURL?>/css/main.css">
		
		<script type="text/javascript">
			var HOST = '<?=HOST?>';
			var SKIN_URL = '<?=MEDIAURL?>';
			var CL = '<?=$this->uri->segment(1)?>';
		</script>
                <script type="text/javascript" src="<?=MEDIAURL?>/js/libs/jquery-1.6.1.min.js"></script>
                <script type="text/javascript" src="<?=MEDIAURL?>/js/libs/cookie.js"></script>
                <script type="text/javascript" src="<?=MEDIAURL?>/js/script.js"></script>
		
	</head>
	<body>
		<div id="wrapper">
		    {HEADER}
		    <div id="content">
		        <div class="page_title">
		            {title_of_page}
		        </div>
		        <div class="rightside">
		                {LOOKED_ADS}
		        </div>
		        <div class="sam_kontent">
		           {MSG}  
		           {CONTENT}
		        </div>
		        <div class="clr"></div>
		    </div>  
		    {FOOTER}  
		</div>
	</body>
</html>