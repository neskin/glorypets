<div class="container glossary_search">
        <div class="page_title">{i_search}</div>
	<div class="category_block">
            <select>
                <option value="0" selected="selected">No</option>
                <? foreach($glossary_category as $k=>$v):?>
                <option value="<?=$v['glossarycategory_id']?>"><?=$v['glossarycategory_name']?></option>
                <? endforeach;?>
            </select>
            <div class="category">
            </div>
        </div>
	<div class="character_block">
	<? foreach($this->tp->D['glossary_search'] as $k=>$v):?>
            <div class="character">
            <?=$v['glossarycharacter_name']?>:<span><a>1</a><a>2</a><a>3</a><a>4</a><a>5</a></span>
            </div>
	<? endforeach;?>
	</div>
</div>