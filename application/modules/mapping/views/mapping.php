<? $v = $this->tp->D['single'] ?>
<div class="container_left news_last">
	<div class="news_list_last">
		<div class="list_soc">
			<div class="right">
				<div class="list_author">{author}: Admin</div>
				<div class="list_com">{comments}: <?=$v['news_comment'] ?> </div>
				<div class="list_view">{views}: <?=$v['news_view'] ?></div>
			</div>
		</div>
		<div class="list_title"><?=$v['news_category_name'] ?> - <?=$v['news_name'] ?></div>
		<div class="list_date">{news_time}: <?=transform_time($v['news_time'], true)?></div>
		<div class="list_img"><img src="<?='news/'.$v['news_image'] ?>" /></div>
		<div class="list_text"><?=$v['news_text'] ?></div>
		<div class="list_likes">
			<div class="tags">#Тег1, #Тег2, #Тег3</div>
			<div class="shares">Поделиться новостью:</div>
		</div>
	</div>
</div>
<div class="container_right">
	{GLOSSARY_TOP}
	{NEWS_BLOCK}
</div>