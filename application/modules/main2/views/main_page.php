
<div id="main">
<h1 class="title main_title"><?=$header?></h1>
<? foreach($topics as $k=>$v):?>
<p>
<h3><?=$v->topics_name;?></h3>
: <?=$v->topics_text;?></p>
<? endforeach;?></div>
