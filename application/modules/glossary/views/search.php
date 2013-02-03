<div class="container glossary">
	<div class="page_title">{page_glossary}</div>
	<div class="search_letter_block">
            <div class="alphabet_search radius">
                <div class="alphabet"><span>{alphabet_search}Поиск по алфивиту: </span>
                    <span id="search_by_letter">
                        <? foreach($this->tp->D['alphabet'] as $v):?>
                        <a onClick="javascript: gletter_search($(this));" ><?=$v?></a>
                        <? endforeach; ?>
                    </span>
                    <span>{or}или</span><a>{big_search}Расширеный поиск</a>
                    <form name="glossary_search" method="post" action="<?=HOST?>ru/glossary/search/">
                        <input id="letter_search" type="hidden" name="letter_search" value="0" />
                    </form>
                </div>
            </div>
        </div>
</div>
<div class="container_left glossary gsearch">
	<div class="page_title">{all_glossary}</div>
	<? foreach($this->tp->D['glossary'] as $k=>$v): ?>
	<div class="glossary_list">		
		<div class="list_img"><a><img src="<?=MEDIAURL?>" /></a></div>
		<a href="<?=HOST?>ru/glossary/single/<?=$v['glossary_id']?>/" class="list_title"><?=$v['glossary_name'] ?></a>
		<div class="list_text"><?=$v['glossary_description'] ?></div>
	</div>
	<? endforeach; ?>
	<div class="clr"></div>
</div>
<div class="container_right glossary gsearch">
        {GLOSSARY_SEARCH}
	<div class="clr"></div>
</div>