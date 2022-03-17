<?php
/**
* @file
* Default theme implementation to display a node.
*
* Available variables:
* - $title: the (sanitized) title of the node.
* - $content: An array of node items. Use render($content) to print them all,
* or print a subset such as render($content['field_example']). Use
* hide($content['field_example']) to temporarily suppress the printing of a
* given element.
* - $user_picture: The node author's picture from user-picture.tpl.php.
* - $date: Formatted creation date. Preprocess functions can reformat it by
* calling format_date() with the desired parameters on the $created variable.
* - $name: Themed username of node author output from theme_username().
* - $node_url: Direct URL of the current node.
* - $display_submitted: Whether submission information should be displayed.
* - $submitted: Submission information created from $name and $date during
* template_preprocess_node().
* - $classes: String of classes that can be used to style contextually through
* CSS. It can be manipulated through the variable $classes_array from
* preprocess functions. The default values can be one or more of the
* following:
* - node: The current template type; for example, "theming hook".
* - node-[type]: The current node type. For example, if the node is a
* "Blog entry" it would result in "node-blog". Note that the machine
* name will often be in a short form of the human readable label.
* - node-teaser: Nodes in teaser form.
* - node-preview: Nodes in preview mode.
* The following are controlled through the node publishing options.
* - node-promoted: Nodes promoted to the front page.
* - node-sticky: Nodes ordered above other non-sticky nodes in teaser
* listings.
* - node-unpublished: Unpublished nodes visible only to administrators.
* - $title_prefix (array): An array containing additional output populated by
* modules, intended to be displayed in front of the main title tag that
* appears in the template.
* - $title_suffix (array): An array containing additional output populated by
* modules, intended to be displayed after the main title tag that appears in
* the template.
*
* Other variables:
* - $node: Full node object. Contains data that may not be safe.
* - $type: Node type; for example, story, page, blog, etc.
* - $comment_count: Number of comments attached to the node.
* - $uid: User ID of the node author.
* - $created: Time the node was published formatted in Unix timestamp.
* - $classes_array: Array of html class attribute values. It is flattened
* into a string within the variable $classes.
* - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
* teaser listings.
* - $id: Position of the node. Increments each time it's output.
*
* Node status variables:
* - $view_mode: View mode; for example, "full", "teaser".
* - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
* - $page: Flag for the full page state.
* - $promote: Flag for front page promotion state.
* - $sticky: Flags for sticky post setting.
* - $status: Flag for published status.
* - $comment: State of comment settings for the node.
* - $readmore: Flags true if the teaser content of the node cannot hold the
* main body content.
* - $is_front: Flags true when presented in the front page.
* - $logged_in: Flags true when the current user is a logged-in member.
* - $is_admin: Flags true when the current user is an administrator.
*
* Field variables: for each field instance attached to the node a corresponding
* variable is defined; for example, $node->body becomes $body. When needing to
* access a field's raw values, developers/themers are strongly encouraged to
* use these variables. Otherwise they will have to explicitly specify the
* desired field language; for example, $node->body['en'], thus overriding any
* language negotiation rule that was previously applied.
*
* @see template_preprocess()
* @see template_preprocess_node()
* @see template_process()
*
* @ingroup themeable
*/

$pathroot = 'http://nonprofit.xarxanet.org';

// Data
$mesos = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$dies = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
$node = $build['#node'];

$id_newsletter = $node->title['und'];

//Noticia principal esquerra
$noticia_prin_esq = array();
if ($node_ =  node_load($node->field_prin_xarxanet_esq['und'][0]['nid'])) {
	//Noticia Xarxanet
	if (isset($node_->field_agenda_imatge['und'][0]['uri'])){
		$noticia_prin_esq['imatge'] = image_style_url('xn19_newsletter_medium',$node_->field_agenda_imatge['und'][0]['uri']);
		$noticia_prin_esq['alt'] = $node_->field_agenda_imatge['und'][0]['alt'];
	}else{
		$noticia_prin_esq['imatge'] = image_style_url('xn19_newsletter_medium', $node_->field_imatges['und'][0]['uri']);
		$noticia_prin_esq['alt'] = $node_->field_imatges['und'][0]['data']['alt'];
	}
	$noticia_prin_esq['title'] = $node_->title;
	if (isset($node->field_prin_abstract_esq['und'][0]['value'])){
		$noticia_prin_esq['teaser'] = strip_tags($node->field_prin_abstract_esq['und'][0]['value']);
	}else{
		$noticia_prin_esq['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$noticia_prin_esq['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
} else {
	//Noticia externa
	$noticia_prin_esq['title'] = $node->field_prin_ext_esq['und'][0]['title'];
	$noticia_prin_esq['link'] = $node->field_prin_ext_esq['und'][0]['url'];
	$noticia_prin_esq['teaser'] = strip_tags($node->field_prin_abstract_esq['und'][0]['value']);
	$noticia_prin_esq['imatge'] = file_create_url($node->field_prin_picture_esq['und'][0]['uri']);
	$noticia_prin_esq['alt'] = $node->field_prin_picture_esq['und'][0]['data']['alt'];
}

//Noticia principal dreta
$noticia_prin_dreta = array();
if ($node_ =  node_load($node->field_prin_xarxanet_dreta['und'][0]['nid'])) {
	//Noticia Xarxanet
	if (isset($node_->field_agenda_imatge['und'][0]['uri'])){
		$noticia_prin_dreta['imatge'] = image_style_url('xn19_newsletter_medium',$node_->field_agenda_imatge['und'][0]['uri']);
		$noticia_prin_dreta['alt'] = $node_->field_agenda_imatge['und'][0]['alt'];
	}else{
		$noticia_prin_dreta['imatge'] = image_style_url('xn19_newsletter_medium', $node_->field_imatges['und'][0]['uri']);
		$noticia_prin_dreta['alt'] = $node_->field_imatges['und'][0]['data']['alt'];
	}
	$noticia_prin_dreta['title'] = $node_->title;
	if (isset($node->field_prin_abstract_dreta['und'][0]['value'])){
		$noticia_prin_dreta['teaser'] = strip_tags($node->field_prin_abstract_dreta['und'][0]['value']);
	}else{
		$noticia_prin_dreta['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$noticia_prin_dreta['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
} else {
	//Noticia Externa
	$noticia_prin_dreta['title'] = $node->field_prin_ext_dreta['und'][0]['title'];
	$noticia_prin_dreta['link'] = $node->field_prin_ext_dreta['und'][0]['url'];
	$noticia_prin_dreta['teaser'] = strip_tags($node->field_prin_abstract_dreta['und'][0]['value']);
	$noticia_prin_dreta['imatge'] = file_create_url($node->field_prin_picture_dreta['und'][0]['uri']);
	$noticia_prin_dreta['alt'] = $node->field_prin_picture_dreta['und'][0]['data']['alt'];
}


//Noticia secundaria esquerra
$noticia_secundaria_esq = array();
if ($node_ =  node_load($node->field_sec_xarxanet_esq['und'][0]['nid'])) {
	//Noticia Xarxanet
	if (isset($node_->field_agenda_imatge['und'][0]['uri'])){
		$noticia_secundaria_esq['imatge'] = image_style_url('xn19_newsletter_medium',$node_->field_agenda_imatge['und'][0]['uri']);
		$noticia_secundaria_esq['alt'] = $node_->field_agenda_imatge['und'][0]['alt'];
	}else{
		$noticia_secundaria_esq['imatge'] = image_style_url('xn19_newsletter_medium', $node_->field_imatges['und'][0]['uri']);
		$noticia_secundaria_esq['alt'] = $node_->field_imatges['und'][0]['data']['alt'];
	}
	$noticia_secundaria_esq['title'] = $node_->title;
	if (isset($node->field_sec_abstract_esq['und'][0]['value'])){
		$noticia_secundaria_esq['teaser'] = strip_tags($node->field_sec_abstract_esq['und'][0]['value']);
	}else{
		$noticia_secundaria_esq['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$noticia_secundaria_esq['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
} else {
	//Noticia Externa
	$noticia_secundaria_esq['title'] = $node->field_sec_ext_esq['und'][0]['title'];
	$noticia_secundaria_esq['link'] = $node->field_sec_ext_esq['und'][0]['url'];
	$noticia_secundaria_esq['teaser'] = strip_tags($node->field_sec_abstract_esq['und'][0]['value']);
	$noticia_secundaria_esq['imatge'] = file_create_url($node->field_sec_picture_esq['und'][0]['uri']);
	$noticia_secundaria_esq['alt'] = $node->field_sec_picture_esq['und'][0]['data']['alt'];
}

//Noticia secundaria dreta
$noticia_secundaria_dreta = array();
if ($node_ =  node_load($node->field_sec_xarxanet_dreta['und'][0]['nid'])) {
	//Noticia Xarxanet
	if (isset($node_->field_agenda_imatge['und'][0]['uri'])){
		$noticia_secundaria_dreta['imatge'] = image_style_url('xn19_newsletter_medium',$node_->field_agenda_imatge['und'][0]['uri']);
		$noticia_secundaria_dreta['alt'] = $node_->field_agenda_imatge['und'][0]['alt'];
	}else{
		$noticia_secundaria_dreta['imatge'] = image_style_url('xn19_newsletter_medium', $node_->field_imatges['und'][0]['uri']);
		$noticia_secundaria_dreta['alt'] = $node_->field_imatges['und'][0]['data']['alt'];
	}
	$noticia_secundaria_dreta['title'] = $node_->title;
	if (isset($node->field_sec_abstract_dreta['und'][0]['value'])){
		$noticia_secundaria_dreta['teaser'] = strip_tags($node->field_sec_abstract_dreta['und'][0]['value']);
	}else{
		$noticia_secundaria_dreta['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$noticia_secundaria_dreta['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
} else {
	//Noticia Externa
	$noticia_secundaria_dreta['title'] = $node->field_sec_ext_dreta['und'][0]['title'];
	$noticia_secundaria_dreta['link'] = $node->field_sec_ext_dreta['und'][0]['url'];
	$noticia_secundaria_dreta['teaser'] = strip_tags($node->field_sec_abstract_dreta['und'][0]['value']);
	$noticia_secundaria_dreta['imatge'] = file_create_url($node->field_sec_picture_dreta['und'][0]['uri']);
	$noticia_secundaria_dreta['alt'] = $node->field_sec_picture_dreta['und'][0]['data']['alt'];
}

//Noticia terciaria esquerra
$noticia_terciaria_esq = array();
if ($node_ =  node_load($node->field_ter_xarxanet_esq['und'][0]['nid'])) {
	//Noticia Xarxanet
	if (isset($node_->field_agenda_imatge['und'][0]['uri'])){
		$noticia_terciaria_esq['imatge'] = image_style_url('xn19_newsletter_medium',$node_->field_agenda_imatge['und'][0]['uri']);
		$noticia_terciaria_esq['alt'] = $node_->field_agenda_imatge['und'][0]['alt'];
	}else{
		$noticia_terciaria_esq['imatge'] = image_style_url('xn19_newsletter_medium', $node_->field_imatges['und'][0]['uri']);
		$noticia_terciaria_esq['alt'] = $node_->field_imatges['und'][0]['data']['alt'];
	}
	$noticia_terciaria_esq['title'] = $node_->title;
	if (isset($node->field_ter_abstract_esq['und'][0]['value'])){
		$noticia_terciaria_esq['teaser'] = strip_tags($node->field_ter_abstract_esq['und'][0]['value']);
	}else{
		$noticia_terciaria_esq['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$noticia_terciaria_esq['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
} else {
	//Noticia Externa
	$noticia_terciaria_esq['title'] = $node->field_ter_ext_esq['und'][0]['title'];
	$noticia_terciaria_esq['link'] = $node->field_ter_ext_esq['und'][0]['url'];
	$noticia_terciaria_esq['teaser'] = strip_tags($node->field_ter_abstract_esq['und'][0]['value']);
	$noticia_terciaria_esq['imatge'] = file_create_url($node->field_ter_picture_esq['und'][0]['uri']);
	$noticia_terciaria_esq['alt'] = $node->field_ter_picture_esq['und'][0]['data']['alt'];
}

//Noticia terciaria dreta
$noticia_terciaria_dreta = array();
if ($node_ =  node_load($node->field_ter_xarxanet_dreta['und'][0]['nid'])) {
	//Noticia Xarxanet
	if (isset($node_->field_agenda_imatge['und'][0]['uri'])){
		$noticia_terciaria_dreta['imatge'] = image_style_url('xn19_newsletter_medium',$node_->field_agenda_imatge['und'][0]['uri']);
		$noticia_terciaria_dreta['alt'] = $node_->field_agenda_imatge['und'][0]['alt'];
	}else{
		$noticia_terciaria_dreta['imatge'] = image_style_url('xn19_newsletter_medium', $node_->field_imatges['und'][0]['uri']);
		$noticia_terciaria_dreta['alt'] = $node_->field_imatges['und'][0]['data']['alt'];
	}
	$noticia_terciaria_dreta['title'] = $node_->title;
	if (isset($node->field_ter_abstract_dreta['und'][0]['value'])){
		$noticia_terciaria_dreta['teaser'] = strip_tags($node->field_ter_abstract_dreta['und'][0]['value']);
	}else{
		$noticia_terciaria_dreta['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$noticia_terciaria_dreta['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
} else {
	//Noticia Externa
	$noticia_terciaria_dreta['title'] = $node->field_ter_ext_dreta['und'][0]['title'];
	$noticia_terciaria_dreta['link'] = $node->field_ter_ext_dreta['und'][0]['url'];
	$noticia_terciaria_dreta['teaser'] = strip_tags($node->field_ter_abstract_dreta['und'][0]['value']);
	$noticia_terciaria_dreta['imatge'] = file_create_url($node->field_ter_picture_dreta['und'][0]['uri']);
	$noticia_terciaria_dreta['alt'] = $node->field_ter_picture_dreta['und'][0]['data']['alt'];
}

//OPINION PRIMER ARTICLE
$opinion_primera = array();
if ($node_ =  node_load($node->field_opinio_primer_xarxanet['und'][0]['nid'])) {
	//Opinion Xarxanet
	if ($node_->field_square_photo){
		$opinion_primera['imatge'] = image_style_url('xn19_newsletter_small', $node_->field_square_photo['und'][0]['uri']);
		$opinion_primera['alt'] = $node_->field_square_photo['und'][0]['data']['alt'];
	} else {
		$node_autor =  node_load($node_->field_opinion_author['und'][0]['nid']);
		$opinion_primera['imatge'] = image_style_url('xn19_newsletter_small',$node_autor->field_square_photo['und'][0]['uri']);
		$opinion_primera['alt'] = $node_autor->field_square_photo['und'][0]['alt'];
	}
	$opinion_primera['title'] = $node_->title;
	if (isset($node->field_opinio_primer_abstract['und'][0]['value'])){
		$opinion_primera['teaser'] = strip_tags($node->field_opinio_primer_abstract['und'][0]['value']);
	}else{
		$opinion_primera['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$opinion_primera['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
}

//OPINION SEGON ARTICLE
$opinion_segona = array();
if ($node_ =  node_load($node->field_opinio_segon_xarxanet['und'][0]['nid'])) {
	//Opinion Xarxanet
	if ($node_->field_square_photo){
		$opinion_segona['imatge'] = image_style_url('xn19_newsletter_small', $node_->field_square_photo['und'][0]['uri']);
		$opinion_segona['alt'] = $node_->field_square_photo['und'][0]['data']['alt'];
	} else {
		$node_autor =  node_load($node_->field_opinion_author['und'][0]['nid']);
		$opinion_segona['imatge'] = image_style_url('xn19_newsletter_small',$node_autor->field_square_photo['und'][0]['uri']);
		$opinion_segona['alt'] = $node_autor->field_square_photo['und'][0]['alt'];
	}
	$opinion_segona['title'] = $node_->title;
	if (isset($node->field_opinio_segon_abstract['und'][0]['value'])){
		$opinion_segona['teaser'] = strip_tags($node->field_opinio_segon_abstract['und'][0]['value']);
	}else{
		$opinion_segona['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$opinion_segona['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
}

//OPINION TERCER ARTICLE
$opinion_tercera = array();
if ($node_ =  node_load($node->field_opinio_tercer_xarxanet['und'][0]['nid'])) {
	//Opinion Xarxanet
	if ($node_->field_square_photo){
		$opinion_tercera['imatge'] = image_style_url('xn19_newsletter_small', $node_->field_square_photo['und'][0]['uri']);
		$opinion_tercera['alt'] = $node_->field_square_photo['und'][0]['data']['alt'];
	} else {
		$node_autor =  node_load($node_->field_opinion_author['und'][0]['nid']);
		$opinion_tercera['imatge'] = image_style_url('xn19_newsletter_small',$node_autor->field_square_photo['und'][0]['uri']);
		$opinion_tercera['alt'] = $node_autor->field_square_photo['und'][0]['alt'];
	}
	$opinion_tercera['title'] = $node_->title;
	if (isset($node->field_opinio_tercer_abstract['und'][0]['value'])){
		$opinion_tercera['teaser'] = strip_tags($node->field_opinio_tercer_abstract['und'][0]['value']);
	}else{
		$opinion_tercera['teaser'] = strip_tags($node_->field_resum['und'][0]['value']);
	}
	$opinion_tercera['link'] = url('node/' . $node_->nid, array('absolute' => TRUE));
}
?>
<!--[if (gte mso 9)|(IE)]>
<table width="600" align="center">
<tr>
<td>
<![endif]-->
<center class="wrapper">
	<div class="webkit">
		<table class="outer" align="center" cellpadding="0" cellspacing="0" border="0">
		    <tr>
				<td class="one-column">
					<table width="100%" class="contents">
						<tr>
							<td align="center" class="inner">
								<!--[if (gte mso 9)|(IE)]>
						        <table width="272">
						        <tr>
						        <td width="100%">
						        <![endif]-->
								<table width="100%">
									<tr>
										<td align="right">
											<a href="<?php echo $pathroot.'/node/'.$node->nid?>">View in web browser</a>
										</td>
									</tr>
								</table>
								<!--[if (gte mso 9)|(IE)]>
						        </td>
						        </tr>
						        </table>
						        <![endif]-->
							</td>
						</tr>
					</table>
				</td>
			</tr>
		    <tr>
			    <td class="two-column capcalera">
			        <!--[if (gte mso 9)|(IE)]>
			        <table width="100%">
			        <tr>
			        <td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td class="inner">
					            	<table class="contents">
									    <tr>
									        <td class="logo">
									            <a href="http://nonprofit.xarxanet.org">
													<img src="http://nonprofit.xarxanet.org/sites/nonprofit.xarxanet.org/themes/sasson_nonprofit/logo.png" alt="logotip xarxanet"/>
												</a>
									        </td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td><td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td class="inner">
					            	<table class="contents">
									    <tr>
									        <td>
					                			<p>Newsletter</p>
					            			</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td>
			        </tr>
			        </table>
			        <![endif]-->
			    </td>
			</tr>
			<tr>
			    <td class="two-column sub-capcelera">
			        <!--[if (gte mso 9)|(IE)]>
			        <table width="100%">
			        <tr>
			        <td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td>
					            	<table class="contents">
									    <tr>
									        <td class="data">
					                            <?php
													$created = $node->created;
													echo $dies[date('N', $created)-1].', '.date('d', $created). ' '.$mesos[date('n', $created)-1].' '.date('Y', $created).' - No. '.$title;
												?>
											</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td><td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td>
					            	<table class="contents">
									    <tr>
									        <td>
					                			<a href="http://nonprofit.xarxanet.org/newsletter-archive">
					                				Previous Newsletters
					                			</a>
					                		</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td>
			        </tr>
			        </table>
			        <![endif]-->
			    </td>
			</tr>
			<tr>
				<td colspan="2" style="padding:0 10px;vertical-align: top; text-align:right">
					<p style="margin:0;font-size:14px;color:#2f3031;;">ISSN 2696-9734</p>
				</td>
			</tr>
			<tr>
				<td class="one-column">
					<table width="100%" class="contents">
						<tr>
							<td align="center" class="inner">
								<!--[if (gte mso 9)|(IE)]>
						        <table width="272">
						        <tr>
						        <td width="100%">
						        <![endif]-->
								<table width="272">
									<tr>
										<td class="titol-seccio h1">
											News &amp; Interviews
										</td>
									</tr>
								</table>
								<!--[if (gte mso 9)|(IE)]>
						        </td>
						        </tr>
						        </table>
						        <![endif]-->
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
			    <td class="two-column">
			        <!--[if (gte mso 9)|(IE)]>
			        <table width="100%">
			        <tr>
			        <td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td class="inner">
					            	<table class="contents">
									    <tr>
									        <td>
									            <a href="<?php echo $noticia_prin_esq['link']?>">
													<img class="img-article" src="<?php echo $noticia_prin_esq['imatge']?>" alt="<?php echo $noticia_prin_esq['alt']?>" width="272"/>
												</a>
									        </td>
									    </tr>
									    <tr>
									        <td class="text">
									            <a href="<?php echo $noticia_prin_esq['link']?>" class="h2">
													<?php echo $noticia_prin_esq['title']?>
												</a>
									        </td>
									    </tr>
									    <tr>
									    	<td class="text">
									    		<p style="margin: 2px 0;"><?php echo $noticia_prin_esq['teaser']?></p>
									    	</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td><td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td class="inner">
					            	<table class="contents">
									    <tr>
									        <td>
									            <a href="<?php echo $noticia_prin_dreta['link']?>">
													<img class="img-article" src="<?php echo $noticia_prin_dreta['imatge']?>" alt="<?php echo $noticia_prin_dreta['alt']?>" width="272"/>
												</a>
									        </td>
									    </tr>
									    <tr>
									        <td class="text">
									            <a href="<?php echo $noticia_prin_dreta['link']?>" class="h2">
													<?php echo $noticia_prin_dreta['title']?>
												</a>
									        </td>
									    </tr>
									    <tr>
									    	<td class="text">
									    		<p style="margin: 2px 0;"><?php echo $noticia_prin_dreta['teaser']?></p>
									    	</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td>
			        </tr>
			        </table>
			        <![endif]-->
			    </td>
			</tr>
			<tr>
			    <td class="two-column">
			        <!--[if (gte mso 9)|(IE)]>
			        <table width="100%">
			        <tr>
			        <td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td class="inner">
					            	<table class="contents">
									    <tr>
									        <td>
									            <a href="<?php echo $noticia_secundaria_esq['link']?>" style="text-decoration:none">
													<img class="img-article" src="<?php echo $noticia_secundaria_esq['imatge']?>" alt="<?php echo $noticia_secundaria_esq['alt']?>" width="272"/>
												</a>
									        </td>
									    </tr>
									    <tr>
									        <td class="text">
									            <a href="<?php echo $noticia_secundaria_esq['link']?>" class="h2">
													<?php echo $noticia_secundaria_esq['title']?>
												</a>
									        </td>
									    </tr>
									    <tr>
									    	<td class="text">
									    		<p style="margin: 2px 0;"><?php echo $noticia_secundaria_esq['teaser']?></p>
									    	</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td><td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td class="inner">
					            	<table class="contents">
									    <tr>
									        <td>
									            <a href="<?php echo $noticia_secundaria_dreta['link']?>" style="text-decoration:none">
													<img class="img-article" src="<?php echo $noticia_secundaria_dreta['imatge']?>" alt="<?php echo $noticia_secundaria_dreta['alt']?>" width="272"/>
												</a>
									        </td>
									    </tr>
									    <tr>
									        <td class="text">
									            <a href="<?php echo $noticia_secundaria_dreta['link']?>" class="h2">
													<?php echo $noticia_secundaria_dreta['title']?>
												</a>
									        </td>
									    </tr>
									    <tr>
									    	<td class="text">
									    		<p style="margin: 2px 0;"><?php echo $noticia_secundaria_dreta['teaser']?></p>
									    	</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td>
			        </tr>
			        </table>
			        <![endif]-->
			    </td>
			</tr>
			<?php
			if (isset($noticia_terciaria_esq['link'])){
			?>
			<tr>
			    <td class="two-column">
			        <!--[if (gte mso 9)|(IE)]>
			        <table width="100%">
			        <tr>
			        <td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td class="inner">
					            	<table class="contents">
									    <tr>
									        <td>
									            <a href="<?php echo $noticia_terciaria_esq['link']?>" style="text-decoration:none">
													<img class="img-article" src="<?php echo $noticia_terciaria_esq['imatge']?>" alt="<?php echo $noticia_terciaria_esq['alt']?>" width="272"/>
												</a>
									        </td>
									    </tr>
									    <tr>
									        <td class="text">
									            <a href="<?php echo $noticia_terciaria_esq['link']?>" class="h2">
													<?php echo $noticia_terciaria_esq['title']?>
												</a>
									        </td>
									    </tr>
									    <tr>
									    	<td class="text">
									    		<p style="margin: 2px 0;"><?php echo $noticia_terciaria_esq['teaser']?></p>
									    	</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td><td width="50%" valign="top">
			        <![endif]-->
			        <div class="column">
					    <table width="100%">
					        <tr>
					            <td class="inner">
					            	<table class="contents">
									    <tr>
									        <td>
									            <a href="<?php echo $noticia_terciaria_dreta['link']?>" style="text-decoration:none">
													<img class="img-article" src="<?php echo $noticia_terciaria_dreta['imatge']?>" alt="<?php echo $noticia_terciaria_dreta['alt']?>" width="272"/>
												</a>
									        </td>
									    </tr>
									    <tr>
									        <td class="text">
									            <a href="<?php echo $noticia_terciaria_dreta['link']?>" class="h2">
													<?php echo $noticia_terciaria_dreta['title']?>
												</a>
									        </td>
									    </tr>
									    <tr>
									    	<td class="text">
									    		<p style="margin: 2px 0;"><?php echo $noticia_terciaria_dreta['teaser']?></p>
									    	</td>
									    </tr>
									</table>
					            </td>
					        </tr>
					    </table>
					</div>
			        <!--[if (gte mso 9)|(IE)]>
			        </td>
			        </tr>
			        </table>
			        <![endif]-->
			    </td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td class="one-column">
					<table width="100%" class="contents">
						<tr>
							<td align="center" class="inner">
								<table width="185">
									<tr>
										<td class="titol-seccio h1">
											Opinion
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
		    <td class="three-column">
		        <!--[if (gte mso 9)|(IE)]>
		        <table width="100%">
		        <tr>
		        <td width="200" valign="top">
		        <![endif]-->
		        <table class="column">
				    <tr>
				        <td class="inner">
				            <table class="contents">
				                <tr>
				                    <td>
				                        <a href="<?php echo $opinion_primera['link']?>" style="text-decoration:none">
											<img src="<?php echo $opinion_primera['imatge']?>" width="180" alt="<?php echo $opinion_primera['alt']?>"/>
										</a>
				                    </td>
				                </tr>
				                <tr>
				                    <td class="text">
				                        <a href="<?php echo $opinion_primera['link']?>" class="h2">
											<?php echo $opinion_primera['title']?>
										</a>
				                    </td>
				                </tr>
				                <tr>
				                    <td class="text">
				                        <p style="margin: 2px 0;"><?php echo $opinion_primera['teaser']?></p>
				                    </td>
				                </tr>
				            </table>
				        </td>
				    </tr>
				</table>
		        <!--[if (gte mso 9)|(IE)]>
		        </td><td width="200" valign="top">
		        <![endif]-->
		        <table class="column">
				    <tr>
				        <td class="inner">
				            <table class="contents">
				                <tr>
				                    <td>
				                        <a href="<?php echo $opinion_segona['link']?>" style="text-decoration:none">
											<img src="<?php echo $opinion_segona['imatge']?>" width="180" alt="<?php echo $opinion_segona['alt']?>"/>
										</a>
				                    </td>
				                </tr>
				                <tr>
				                    <td class="text">
				                        <a href="<?php echo $opinion_segona['link']?>" class="h2">
											<?php echo $opinion_segona['title']?>
										</a>
				                    </td>
				                </tr>
				                <tr>
				                    <td class="text">
				                        <p style="margin: 2px 0;"><?php echo $opinion_segona['teaser']?></p>
				                    </td>
				                </tr>
				            </table>
				        </td>
				    </tr>
				</table>
		        <!--[if (gte mso 9)|(IE)]>
		        </td><td width="200" valign="top">
		        <![endif]-->
		        <table class="column">
				    <tr>
				        <td class="inner">
				            <table class="contents">
				                <tr>
				                    <td>
				                        <a href="<?php echo $opinion_tercera['link']?>" style="text-decoration:none">
											<img src="<?php echo $opinion_tercera['imatge']?>" width="180" alt="<?php echo $opinion_tercera['alt']?>"/>
										</a>
				                    </td>
				                </tr>
				                <tr>
				                    <td class="text">
				                        <a href="<?php echo $opinion_tercera['link']?>" class="h2">
											<?php echo $opinion_tercera['title']?>
										</a>
				                    </td>
				                </tr>
				                <tr>
				                    <td class="text">
				                        <p style="margin: 2px 0;"><?php echo $opinion_tercera['teaser']?></p>
				                    </td>
				                </tr>
				            </table>
				        </td>
				    </tr>
				</table>
		        <!--[if (gte mso 9)|(IE)]>
		        </td>
		        </tr>
		        </table>
		        <![endif]-->
		    </td>
			</tr>
			<tr>
				<td class="peu">
					<table width="100%">
						<tr>
							<td class="inner">
								<p>nonprofit.xarxanet.org is a project of</p>
							</td>
						</tr>
						<tr>
						    <td class="two-column">
						        <!--[if (gte mso 9)|(IE)]>
						        <table width="100%">
						        <tr>
						        <td width="50%" valign="top">
						        <![endif]-->
						        <div class="column">
								    <table width="100%">
								        <tr>
								            <td class="inner">
								            	<table class="contents">
												    <tr>
												        <td>
												            <a href="http://benestar.gencat.cat/" target="_blank" title="Generalitat">
												            	<img alt="Logo Generalitat" src="http://nonprofit.xarxanet.org/sites/nonprofit.xarxanet.org/themes/sasson_nonprofit/images/logos/logo-generalitat.png">
												            </a>
												        </td>
												    </tr>
												</table>
								            </td>
								        </tr>
								    </table>
								</div>
						        <!--[if (gte mso 9)|(IE)]>
						        </td><td width="50%" valign="top">
						        <![endif]-->
						        <div class="column">
								    <table width="100%">
								        <tr>
								            <td class="inner">
								            	<table class="contents">
												    <tr>
												        <td>
												            <a href="http://xarxanet.org" target="_blank" title="xarxanet.org">
												            	<img alt="Logo xarxanet.org" src="http://nonprofit.xarxanet.org/sites/nonprofit.xarxanet.org/themes/xn19_nonprofit/img/logo-xarxanet-footer-newsletter.png">
												            </a>
												        </td>
												    </tr>
												</table>
								            </td>
								        </tr>
								    </table>
								</div>
						        <!--[if (gte mso 9)|(IE)]>
						        </td>
						        </tr>
						        </table>
						        <![endif]-->
						    </td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="sub-peu">
					<table width="100%">
						<tr>
							<td class="inner">
								<a href="/newsletter" target="_blank">Subscribe</a> | <a href="/newsletter/unsubscribe" target="_blank">Unsubscribe</a> | <a href="/content/contact-us" target="_blank">Contact us</a> | <a href="/legal-terms" target="_blank">Legal terms</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td class="sub-peu">
			 	<p style="color:#FFFFFF;font-size: 0.75em;padding: 10px 15px;text-align: justify;;"><a style="color:#FFFFFF; text-decoration: underline;" href="/legal-terms">Legal notice</a>: In accordance with article 17.1 of Law 19/2014, the "Generalitat de Catalunya" allows the reuse of the contents and data provided that: the source and update date are quoted, the information therein is not altered (article 8 of Law 37/2007) and it is not contradicted with a specific license. If the email address used in the sign up process ceases to be active, you will be unsubscribed from the database.
				<br/>This newsletter is an initiative of the Department of Work, Social Affairs and Families of the Generalitat de Catalunya, and a joint publication with Pere Tarres Foundation</p>
			</td></tr>
		</table>
	</div>
</center>
<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->
