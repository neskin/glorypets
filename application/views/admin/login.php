<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Авторизация </title>
	<? inc_js('libs/jquery-1.7.2.min')?>
	<? inc_js('admin/scripts_admin')?>
	<? inc_js('admin/auth')?>
	<script type="text/javascript">
		var HOST = '<?=HOST?>';
	</script>
<style>
#authDiv{
	position: relative;
	left: 50%;
	margin-left: -492px;
	height: 611px;
	width: 985px;
	background-image: url(<?php echo MEDIAURL;?>images/admin/login_bg.jpg);
	font-family: Helvetica,Arial;
}

#login{
	background-color:transparent;
	border:0 none;
	color:#FFFFFF;
	font-size:24px;
	height:42px;
	left:97px;
	position:absolute;
	top:247px;
	width:268px;
	padding-left: 10px;
	padding-right: 10px;
}

#password{
	background-color:transparent;
	border:0 none;
	color:#FFFFFF;
	font-size:24px;
	height:42px;
	left:409px;
	padding-left:10px;
	padding-right:10px;
	position:absolute;
	top:247px;
	width:268px;
}

#log_in{
	border:0 none;
	height:44px;
	left:719px;
	position:absolute;
	top:247px;
	width:118px;
	background-color: transparent;
	cursor: pointer;
}

#logo{
	left:723px;
	position:absolute;
	top:110px;
}

#copy{

	left:96px;
	position:absolute;
	top:440px;
}

#copy a{
	color:#FF0000;
	font-size:12px;
	text-decoration: none;
}

#copy a:hover{
	text-decoration: underline;
}
</style>
</head>

<body>
<div id="authDiv">
	<form name="login_form" id="login_form">
		<input type="text" name="login" id="login" value="" />
		<input type="password" name="password" id="password" value="" />
		<!--<input type="checkbox" name="remember" id="remember" value="1" /> - Запомнить меня <br />-->
		<button id="log_in"></button>
	</form>
</div>
</body>
</html>