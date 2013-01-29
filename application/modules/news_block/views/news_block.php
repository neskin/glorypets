<div class="container news_block">
	<div class="right_block">
		<div class="block_title"><?=$this->tp->D['news_block']['date']['today']?></div>
		<? foreach($this->tp->D['news_block']['today'] as $k=>$v):?>
		<a href="<?=HOST?>ru/news/single/<?=$v['news_id']?>/" class="block_link"><?=$v['news_name']?></a>
		<? endforeach;?>
	</div>
	<div class="right_block">
		<div class="block_title"><?=$this->tp->D['news_block']['date']['yesteday']?></div>
		<? foreach($this->tp->D['news_block']['yesteday'] as $k=>$v):?>
			<a href="<?=HOST?>ru/news/single/<?=$v['news_id']?>/" class="block_link"><?=$v['news_name']?></a>
		<? endforeach;?>
	</div>
	<div class="right_block">
		<div class="block_title"><?=$this->tp->D['news_block']['date']['befyesteday']?></div>
		<? foreach($this->tp->D['news_block']['befyesteday'] as $k=>$v):?>
			<a href="<?=HOST?>ru/news/single/<?=$v['news_id']?>/" class="block_link"><?=$v['news_name']?></a>
		<? endforeach;?>
	</div>
</div>