<div id="register_dialog" class="remove_when_hide">
	<div id="register_dialog_top"></div>
	<div id="register_dialog_body">
		<h3><?=l('reg_new_user')?></h3>
		<hr />
		<form method="post" action="<?=HOST.cl()?>/user/register/" name="register">
			<div class="reg_field_cont">
				<?=l('form_name')?>
				<input type="text" name="user_name" class="ra_text nedd_text_reg" value="">
			</div>
			<div class="reg_field_cont">
				E-mail (<?=l('use_for_enter')?>)
				<input type="text" name="user_email" class="ra_text nedd_text_reg reg_mail" value="">
			</div>
			<div class="reg_field_cont">
				<?=l('pass')?>
				<input type="password" name="user_password" class="ra_text nedd_text_reg pass1" value="">
			</div>
			<div class="reg_field_cont">
				<?=l('pass_repeat')?>
				<input type="password" name="user_password" class="ra_text nedd_text_reg pass2" value="">
			</div>
			<div class="reg_field_cont">
				<?=l('form_phone')?>
				<input type="text" name="user_phone" class="ra_text nedd_text_reg" value="">
			</div>
			<div class="reg_field_cont">
				<?=l('address2')?>
				<input type="text" name="user_address" class="ra_text nedd_text_reg" value="">
			</div>
			<div class="rule_agree checkbox" cb_status="0">
				<?=l('with')?> <a href="#" target="_blank"><?=l('rools')?></a> <?=l('ofert')?>
			</div>
			<div class="clr"></div>
		</form>
		<div class="green_btn" id="register_user_now">
			<?=l('register_now')?>
		</div>
		<div class="clr"></div>
	</div>
	<div id="register_dialog_bottom"></div>
	<div class="close_pop_up"></div>
</div>