<div id="tools">
	<?php print $links?>
</div>


		 
	 <div class="image">
	<?php print $mapa?>
	</div>

<div class="e_info">
	<dl class="info">
		<dt><?php print utf8_encode(t("Adre�a"))?></dt>
		<dd><?php print $adreca?></dd>
	</dl>
</div>
<div class="e_info">
	<dl class="info">
		<dt><?php print utf8_encode(t("Organitzador"))?></dt>
		<dd><?php print $organitzador?></dd>
	</dl>
</div>

<div class="e_info">
	<dl class="info">
		<dt><?php print utf8_encode(t("�mbits"))?></dt>
		<?php foreach ($ambits as $ambit):?>
		<dd><?php print $ambit['value']?></dd>
		<?php endforeach;?>
	 </dl>

 </div>
	  
