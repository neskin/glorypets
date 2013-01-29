
		
		
			
		<div id="main">
			<h1 class="title main_title">Добавь верные ингредиенты —<br />приготовь лучший биттер для себя и друзей! </h1>
			<div id="horizontal_area">
				<div class="boiler_container">
					<div class="boiler">
						<div class="ky4ka"></div>
						<div class="sip"></div>
						<div class="smoke"></div>
						<div class="circle_ingr">
							<div class="cir" style="bottom: -20px; right: 160px;"><div style="background: url(<?=SKIN_URL?>/images/ingr_small.png) no-repeat 5px 0px;"></div></div>
							<div class="cir" style="bottom: -40px; right: 80px;"><div style="background: url(<?=SKIN_URL?>/images/ingr_small.png) no-repeat -45px 0px;"></div></div>
							<div class="cir" style="bottom: -25px; right: -5px;"><div style="background: url(<?=SKIN_URL?>/images/ingr_small.png) no-repeat -95px -2px;"></div></div>
							<div class="cir" style="bottom: 45px; right: -45px;"><div style="background: url(<?=SKIN_URL?>/images/ingr_small.png) no-repeat -142px 0px;"></div></div>
							<div class="cir" style="bottom: 120px; right: -35px;"><div style="background: url(<?=SKIN_URL?>/images/ingr_small.png) no-repeat -187px -2px;"></div></div>
						</div>
					</div>
					<div class="drag_hear droppable1"></div>
					
				</div>
				<div id="container">
				<? if(!empty($vars['ingredient_list'])) {?>
					<? foreach($vars['ingredient_list'] as $k=>$v) {?>
						<div class="ingredient_container">
							<div>
								<div class="ingredient0 <?=substr($v[0], 0, -11);?>"></div>
								<div class="ingredient <?=$v[0]?>" check_small="<?=substr($v[0], 0, -11);?>"></div>
							</div>
							<div style="height: 10px; width: 1px; position: relative;"></div>
							<div>
								<div class="ingredient0 <?=substr($v[1], 0, -11);?>"></div>
								<div class="ingredient <?=$v[1]?>" check_small="<?=substr($v[1], 0, -11);?>"></div>
							</div>
							<div style="height: 10px; width: 1px; position: relative;"></div>
							<div>
								<div class="ingredient0 <?=substr($v[2], 0, -11);?>"></div>
								<div class="ingredient <?=$v[2]?>" check_small="<?=substr($v[2], 0, -11);?>"></div>
							</div>
							<div style="height: 10px; width: 1px; position: relative;"></div>
						</div>
					<? }?>
				<? }?>
				</div>
				
			</div>
			<!--<div class="etap">
				<div class="number">1 из 5</div><div class="etitle">этапов</div>
			</div>-->
			<div class="doit" title="Приготовь Becherovka"></div>
			<!--<div class="reiting" style=""><a href="<?//=HOST.cl().'/main/show_reiting/'?>">Рейтинг участников</a></div>-->
			<div class="footer" style="">
				<a target="_blank" href="https://www.facebook.com/notes/becherovka-ukraine/%D0%BE%D1%84%D0%B8%D1%86%D0%B8%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B5-%D0%BF%D1%80%D0%B0%D0%B2%D0%B8%D0%BB%D0%B0-%D0%B0%D0%BA%D1%86%D0%B8%D0%B8-%D1%81%D0%B5%D0%BA%D1%80%D0%B5%D1%82-becherovka/384207981646466" class="rules" style=""></a>
			</div>
		</div>
		
		