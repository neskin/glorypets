<? $v = $this->tp->D['single'] ?>
<div class="container_left news_last">
	<div class="news_list_last">
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
		<div class="list_title"><?=$v['newscategory_name'] ?> - <?=$v['news_name'] ?></div>
		<div class="list_date">{news_time}: <?=transform_time($v['news_time'], true)?></div>
		<div class="list_img"><img src="" /></div>
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