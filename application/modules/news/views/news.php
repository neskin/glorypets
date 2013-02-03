<div class="container news_top">
	<div class="page_title">{page_top_news}</div>
	<? foreach($this->tp->D['news_top'] as $k=>$v): ?>
	<div class="news_list">		
		<div class="list_img"><a href="<?=HOST?>ru/news/single/<?=$v['news_id']?>/"><img src="<?='news/'.$v['news_image'] ?>" /></a></div>
		<a href="<?=HOST?>ru/news/single/<?=$v['news_id']?>/" class="list_title"><?=$v['news_name'] ?></a>
		<div class="list_soc">
			<div class="list_view"><?=$v['news_view'] ?></div>
			<div class="list_com"><?=$v['news_comment'] ?></div>
		</div>
	</div>
	<? endforeach; ?>
	<div class="clr"></div>
	<div class="container more">
		<div id="more_top_news" class="more_btn"></div>
	</div>
</div>
<div class="container_left news_last">
	<div class="page_title">{page_last_news}</div>
	<? foreach($this->tp->D['news_last'] as $k=>$v): ?>
	<div class="news_list_last">
		<div class="list_title"><?=$v['news_name'] ?></div>
		<div class="list_date">{news_time}: <?=transform_time($v['news_time'], true)?></div>
		<div class="list_img"><a href="<?=HOST?>ru/news/single/<?=$v['news_id']?>/"><img src="<?='news/'.$v['news_image'] ?>" /></a></div>
		<div class="list_descr"><?=substr($v['news_description'], 0, 300); ?></div>
		<a href="<?=HOST?>ru/news/single/<?=$v['news_id']?>/" class="list_read">Читать дальше...</a>
		<div class="list_soc radius">
			<div class="left">
				<div id="votenews<?=$v['news_id']?>" class="list_vote">
                                        <div data-id="<?=$v['news_id']?>" data-rate="1" class="vote_good vote">good</div>
                                        <div data-id="<?=$v['news_id']?>" data-rate="0" class="vote_bad vote">bad</div>
                                        <div class="vote_title">{golosov}: <span><?=$v['news_bad']+$v['news_good'] ?></span></div>
                                </div>
				<div class="list_view">{views}: <?=$v['news_view'] ?></div>
				<div class="list_com">{comments}: <?=$v['news_comment'] ?> </div>
				<div class="list_author">{author}: Admin</div>
			</div>
		</div>
	</div>
	<? endforeach; ?>
	<div class="container more">
		<div id="more_top_news" class="more_btn"></div>
	</div>
</div>
<div class="container_right">
	{GLOSSARY_TOP}
	{NEWS_BLOCK}
</div>