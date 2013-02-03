<? $v = $this->tp->D['single'] ?>
<div class="container_left glossary">
	<div class="glossary_single">
		<div class="list_title"><a href="<?=HOST?>ru/glossary/">{glossary_single}</a> - <?=$v['glossary_name'] ?></div>
		<div class="list_img"><img src="" /></div>
                {MAPPING}
		<div class="photos"></div>
		<div class="list_text"><?=$v['glossary_text'] ?></div>
	</div>
</div>
<div class="container_right glossary gsearch">
        <div class="container glossary_search">
            <div class="character_block">
            <? foreach($this->tp->D['character'] as $k=>$v):?>
                <div class="character">
                <?=$v['glossarycharacter_name']?>:<span><?=$v['synh_rate']?></span>
                </div>
            <? endforeach;?>
            </div>
        </div>
	<div class="clr"></div>
</div>