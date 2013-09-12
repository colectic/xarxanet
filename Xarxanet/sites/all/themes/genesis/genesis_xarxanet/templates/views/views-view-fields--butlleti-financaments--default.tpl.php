<?php// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $/** * @file views-view-fields.tpl.php * Default simple view template to all the fields as a row. * * - $view: The view in use. * - $fields: an array of $field objects. Each one contains: *   - $field->content: The output of the field. *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe. *   - $field->class: The safe class id to use. *   - $field->handler: The Views field handler object controlling this field. Do not use *     var_export to dump this object, as it can't handle the recursion. *   - $field->inline: Whether or not the field should be inline. *   - $field->inline_html: either div or span based on the above flag. *   - $field->separator: an optional separator that may appear before a field. * - $row: The raw result object from the query, with all data it fetched. * * @ingroup views_templates */?><?php //krumo($fields); ?><div style="border-bottom: 1px solid #C2C2C2; padding-bottom: 10px; padding-top: 10px; text-decoration: none;"><?php foreach ($fields as $id => $field): ?>      <?php $field->content = str_replace(" (Tot el dia)","",$field->content); ?>      <?php $field->content = str_replace("<span class=\"date-display-single\">","<div style=\"width: 100%;font-weight: bold; text-align: right;\">Termini > ",$field->content); ?>      <?php $field->content = str_replace("</span>","</div>",$field->content); ?>      <?php print str_replace("<a","<a style=\"text-decoration: none; color: #0D75EB;\"",$field->content); ?><?php endforeach; ?>