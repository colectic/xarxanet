<?php
// $Id: views-view-unformatted.tpl.php,v 1.6 2008/10/01 20:52:11 merlinofchaos Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php $term = arg(1); ?>
<?php if ($term): ?>
  <div class="intro">
    <h1 class="title"><?php print $term; ?></h3>
  </div>
<?php endif; ?>
<div class="e_news">
  <ul class="items">
  <?php foreach ($rows as $id =>$row): ?>
    <div class="<?php print $classes[$id]; ?>">
      <?php print $row; ?>
    </div>
  <?php endforeach; ?>
  </ul>
</div>
