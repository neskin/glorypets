<? if(!empty($ar)) {?>
	<ul class="element_list <?=$cl?>">
	<?foreach($ar as $v){?>
	 <li li_id="<?=$v[$li_id]?>" class="li_num_<?=$v[$li_id]?>">
	  <div>
	   <table>
		<tr>
		<?foreach($el as $val){?>
		 <?if(isset($val[1])) $w = ' width="'.$val[1].'"'; else $w = '';?>
		 <?if(isset($val[2]) && $val[2] == 'center') $c = ' style="text-align: center;"'; else $c = '';?>
		 <?
		  preg_match_all("#%([a-zA-Z_]{1,100})%#", $val[0], $m);
		  if(!empty($m[1])){
		   foreach($m[1] as $val1){
			$val[0] = preg_replace("#%".$val1."%#msi", $v[$val1], $val[0]);
		   }
		  } 
		 ?>
		 <td<?=$w?><?=$c?>><?=$val[0]?></td>
		<?}?>
		</tr>
	   </table>
	  </div>
	  <?if(!empty($v['sub_page'])) inc_list($v['sub_page'], $el, $li_id, $cl);?>
	 </li>
	<?}?>
	</ul>
<?} else {?>
	<ul class="element_list">
		<li>
		<div>
			<table>
				<tr>
				<td style="text-align: center;"> Нет элементов</td>
				</tr>
			</table>
		</div>
		</li>
	</ul>
<? }?>