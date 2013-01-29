<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Админ панель</title>
	<? inc_css('admin/admin_style')?>
	<? inc_css('admin/jquery')?>
	<? inc_css('admin/chosen')?>
	<? inc_js('libs/jquery-1.7.2.min')?>
	<? inc_js('admin/ui')?>
	<? inc_js('admin/cookie')?>
	<? inc_js('admin/menu')?>
	<? inc_js('admin/scripts_admin')?>
	<? inc_js('admin/ajax')?>
	<? inc_js('admin/chosen')?>
	<script>
		var HOST = '<?=HOSTADMIN?>';
		var SKIN_URL = '<?=MEDIAURL?>';
		var CL = '<?//=cl()?>';
	</script>
</head>
<body>
	<table id="main_table">
		<tr>
			<!-- ------------------------------------------------------------------------------------ -->
			<td class="left_column"></td>
			<!-- ------------------------------------------------------------------------------------ -->
			<!-- ------------------------------------------------------------------------------------ -->
			<td>
				<?/*if(isset($_SESSION['admin_msg'])){?>
					<?if($vocab = vocab($_SESSION['admin_msg'])){?>
						<div class="top_msg <?=$vocab[0]?>">
							<?=$vocab[1]?>
							<div class="close_top_msg"></div>
						</div>
						<?unset($_SESSION['admin_msg']);?>
					<?}?>
				<?}*/?>
				<div id="lang_container">
					<?/*
						foreach($GLOBALS['langs_list'] as $k=>$v){
							echo '
								<a href="'.HOST.'change_lang/'.$v.'/"'.se($v, cl(), 'class="active"').'>
								<img src="'.SKIN_URL.'images/flags/'.$v.'.jpg"> <span>'.$GLOBALS['langs_name'][$k].'</span>
								</a>
								';
						}
					*/?>
				</div>
				
				<div id="hi_container">
					Привет, <span><?=$this->session->userdata('admin_login')?></span>
					<a href="<?=HOSTADMIN?>logout/">Выход</a>
				</div>
			</td>
			<!-- ------------------------------------------------------------------------------------ -->
		</tr>
		<tr>
			<!-- ------------------------------------------------------------------------------------ -->
			<td class="left_column">
				<img src="<?=MEDIAURL?>images/admin/admin_left_menu_otb.jpg">
				<br /><br />
				<ul id="menu">
					<? $this->load->view('admin/leftmenu', $leftmenu);?>
				</ul>
			</td>
			<!-- ------------------------------------------------------------------------------------ -->
			<!-- ------------------------------------------------------------------------------------ -->
			<td id="main_content">