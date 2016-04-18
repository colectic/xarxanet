<div id="tools">
	<?php print $links?>
</div>


	<div class="e_info">
        <dl class="info">
          <?php if(!empty($autor)): ?>
          <dt><?php print utf8_encode(t("Autor"))?></dt>
          <dd><?php print $autor?></dd>
          <?php endif; ?>
          <dt><?php print utf8_encode(t("Entitat Redactora"))?></dt>
          <dd><?php print $entitat_redactora; ?></dd>

     </div> <!-- .e_info -->
	 <?php if(sizeof($enllacos)>0):?>
	 <div class="e_list2">
        <h2 class="title"><?php print utf8_encode(t("Enlla�os relacionats"))?></h2>
          <ul class="items">
			<?php foreach ($enllacos as $enllac):?>
				<li><a href="<?php print $enllac['url']?>" title="<?php print $enllac['title']?>"><?php print $enllac['title']?></a></li>
			<?php endforeach?>
		  </ul>

     </div> <!-- .e_info -->
	 <?php endif;?>
	 
   <?php if(!empty($tags_relacionats)): ?>
    <?php $results = module_invoke('apachesolr_search','search','search',$tags_relacionats);?>
    <div class="e_list2" style="margin-bottom: 15px;">
    <h2 class="title"><?php print utf8_encode(t("Continguts relacionats:",array(),'ca')) ?></h2>
      <ul class="items">
    <?php $j=0; ?>
    <?php for($i=0;$i<3;$i++):?>
      <?php if($results[$j]['fields']['nid'] != $nodenid): ?>
        <li><a href="<?php print $results[$j]['link'] ?>"><?php print $results[$j]['title'] ?></a></li>
      <?php else: ?>
        <?php $i--; ?>
      <?php endif; ?>
      <?php $j++; ?>
    <?php endfor; ?>
      </ul>
    </div>
    <?php endif; ?> <!-- Fi enlla�os rel�lacionats -->
    
	 <div class="e_info">
        <dl class="info">
          <dt><?php print utf8_encode(t("Valora"))?></dt>
          <dd><?php print $votacio?></dd>
		</dl>
     </div> <!-- .e_info -->
<?php if(sizeof($imatges)>0): ?>
      <div class="e_gallery">
        
		<h2 class="label"><?php print utf8_encode(t("Imatges"))?></h2>
        <ul class="items">
		<?php foreach ($imatges as $imatge):?>
		 <li>
            <a class="thickbox" href="<?php print base_path().$imatge['filepath']?>" rel="lightbox[recurs]" title="<?php print $imatge['data']['alt']?>">
				<?php print theme('imagecache', 'fotografia-noticia', $imatge['filepath'], $imatge['data']['alt'], $imatge['data']['alt'], null);?>
			</a>
            <p class="legend"><?php print $imatge['data']['alt']?></p>
          </li>
		 <?php endforeach;?>
            </ul>
      </div> <!-- .e_gallery -->
	  <?php endif?>
	  