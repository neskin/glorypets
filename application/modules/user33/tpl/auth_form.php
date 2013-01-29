<div id="ra_dialog" class="remove_when_hide">
	<div id="ra_dialog_top"></div>
	<div id="ra_dialog_body">
		<div id="ra_dialog_auth">
			<h3><?=l('uje_pokupal')?></h3>
			<hr />
			<form method="post" action="<?=HOST.cl()?>/user/auth/" name="auth">
				<div class="reg_field_cont">
					E-mail
					<input type="text" name="user_email" class="ra_text nedd_text_auth auth_mail" value="">
				</div>
				<div class="reg_field_cont">
					<?=l('pass')?>
					<input type="password" name="user_password" class="ra_text nedd_text_auth" value="">
				</div>
				<div class="remember_me checkbox" cb_status="0">
					<?=l('rem_me')?>
				</div>
				<input type="hidden" name="remember_me" value="0" id="remember_me">
				<div class="clr"></div>
			</form>
			<div class="green_btn" id="auth_btn">
				<?=l('enter2')?>
			</div>
			<div class="clr"></div>
		</div>
		<div id="ra_dialog_reg">
			<h3><?=l('new_shoper')?></h3>
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
				<div class="rule_agree checkbox active" cb_status="1">
					<?=l('with')?> <a href="#" target="_blank"><?=l('rools')?></a> <?=l('ofert')?>
				</div>
				<div class="clr"></div>
			</form>
			<div class="green_btn" id="register_user_now">
				<?=l('register_now')?>
			</div>
		</div>
		<div id="ra_dialog_hi">
			<img src="<?=SKIN_URL?>images/logo.png">
			
			<div><?=l('welcome')?></div>
			<span><?=l('buro')?></span>
		</div>
		<div class="clr"></div>
	</div>
	<div id="ra_dialog_bottom"></div>
	<div class="close_pop_up"></div>
</div>