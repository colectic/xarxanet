<?php
/**
 * @file views-view-fields.tpl.php
* Default simple view template to all the fields as a row.
*
* - $view: The view in use.
* - $fields: an array of $field objects. Each one contains:
*   - $field->content: The output of the field.
*   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
*   - $field->class: The safe class id to use.
*   - $field->handler: The Views field handler object controlling this field. Do not use
*     var_export to dump this object, as it can't handle the recursion.
*   - $field->inline: Whether or not the field should be inline.
*   - $field->inline_html: either div or span based on the above flag.
*   - $field->separator: an optional separator that may appear before a field.
* - $row: The raw result object from the query, with all data it fetched.
*
* @ingroup views_templates
*/

print '<div id="content-block" >
			<div class="content-block-part">
				<div id="news-block">
					<a href="#">Notícies</a>
				</div>
			</div>
			<div class="content-block-part">
				<div id="events-block">
					<a href="#">Esdeveniments</a>
				</div>
			</div>
		</div>
		<div id="social-block">';
if (($fields['field_pagina_facebook']->content) || ($fields['field_twitter']->content)) print 'Segueix-nos! ';
if ($fields['field_pagina_facebook']->content) {
	print '<a href="'.strip_tags($fields['field_pagina_facebook']->content).'"><img src="/sites/all/themes/sasson_xarxanet/images/icons/fb-icon.png"/></a>';
}
if ($fields['field_twitter']->content) {
	print '<a href="'.strip_tags($fields['field_twitter']->content).'"><img src="/sites/all/themes/sasson_xarxanet/images/icons/twitter-icon.png"/></a>';
}
print '	</div>';


?>
