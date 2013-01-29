<div class="container news_top">
	<div class="page_title">{page_glossary}</div>
	<? foreach($this->tp->D['glossary'] as $k=>$v): ?>
	<div class="news_list">		
		<div class="list_img"><a><img src="<?='glossary/'.$v['glossary_image'] ?>" /></a></div>
		<a class="list_title"><?=$v['glossary_name'] ?></a>
		<div class="list_text"><?=$v['glossary_description'] ?></div>
	</div>
	<? endforeach; ?>
	<div class="clr"></div>
	<div class="container more">
		<div id="more_top_glossary" class="more_btn"></div>
	</div>
</div>