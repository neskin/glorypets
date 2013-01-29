<?
foreach($leftmenu as $v){
?>
	<li<?=se($v[2], array(), '', ' class="has_submenu"')?>>
		<div<?=se($v[1], null, '', ' onClick="javascript: window.location=\''.$v[1].'\'"')?>><?=$v[0]?></div>
		<?
		if(!empty($v[2])){
		?>
			<ul class="submenu">
			<?
			foreach($v[2] as $val){
			?>
				<div<?=se($val[1], null, '', ' onClick="javascript: window.location=\''.$val[1].'\'"')?>><?=$val[0]?></div>
			<?
			}
			?>
			</ul>
		<?	
		}
		?>
		</li>
<?
}
// ааа ?>