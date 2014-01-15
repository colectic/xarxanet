<?php 
// $Id: node.tpl.php,v 1.1.2.8 2009/05/19 00:05:00 jmburnz Exp $

/**
 * @file node.tpl.php
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Helper variables:
 * - $node_id: Outputs a unique id for each node.
 * - $classes: Outputs dynamic classes for advanced themeing.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see genesis_preprocess_node()
 * 
 */
?>

<div id="credits">
		<div id="date"><?php print format_date($node->changed, 'small'); ?></div>
		<div id="author">
			<?php if(isset($node->field_autor[0]['value'])): ?>
            	<b>Autor: </b><?php print $node->field_autor[0]['value']; ?><br />
            <?php endif; ?>
			<b>Entitat redactora: </b><?php print $node->name; ?></div>
		<div id="nothing"></div>
</div>

<?php
	$fileurl = imagecache_create_url('tag-gran', $field_agenda_imatge[0]['filepath']);
	$alt = $field_agenda_imatge[0]['data']['alt'];
	$category_array = array (
		'premi' => array('premi.gif', 'Premis'),
		'subvencio' => array('subvenció.gif', 'Subvenció'),
		'beques' => array('beques.gif', 'Beques'),
		'altres' => array('altres.gif', 'Altres')
	);
?>
 
<div class='image'>
	<img src='<?php print $fileurl ?>' alt='<?php print $alt ?>'/>
</div>
<div id="sub-image-1">
	<div id="category">
		<div id="picto">
			<img src="/<?php print path_to_theme()?>/images/pictos/news-icons/<?php print $category_array[$node->field_finfull_tipus[0]['safe']][0]?>" alt="<?php print $category_array[$node->field_finfull_tipus[0]['safe']][1]?>" />
		</div>
		<div id="category-title"> Finançament > <?php print $category_array[$node->field_finfull_tipus[0]['safe']][1]?></div>
	</div>
	<div id="social-icons">
		<a href="http://www.twitter.com/share?url=<?php print $GLOBALS['base_url'].$node_url ?>">
			<img src="/<?php print path_to_theme()?>/images/pictos/social/twitter.png" alt="compartir a twitter" />
		</a>
		<a href="http://www.facebook.com/sharer/sharer.php?u=<?php print $GLOBALS['base_url'].$node_url ?>">
			<img src="/<?php print path_to_theme()?>/images/pictos/social/facebook.png" alt="compartir a twitter" />
		</a>
		<a href="http://www.plus.google.com/share?url=<?php print $GLOBALS['base_url'].$node_url ?>">
			<img src="/<?php print path_to_theme()?>/images/pictos/social/plus.png" alt="compartir a twitter" />
		</a>
		<a href="/printmail/<?php print $nid ?>">
			<img src="/<?php print path_to_theme()?>/images/pictos/social/mail.png" alt="compartir a twitter" />
		</a>
	</div>
	<div id="nothing"></div>
</div>
<div class="node-body-text">
	<div class="teaser"><?php print $node->field_resum[0]['value']; ?></div>
	
	 <?php if($field_convocant[0]['value']):?>
     <span><b>Convocant:</b></span>
     <?php print $field_convocant[0]['value']; ?>
     <?php endif; ?>
                
     <?php if($field_finfull_data_publicacio[0]['view']):?>
     <span><b>Data publicació:</b></span>
     <p><?php print $field_finfull_data_publicacio[0]['view'] ?></p>
     <?php endif; ?>
                
     <?php if($field_date[0]['view']):?>
     <span><b>Termini:</b></span>
     <p><?php print $field_date[0]['view']; ?></p>
     <?php endif; ?>
                
     <span><b>Contingut:</b></span>
     <p><?php print $node->content['body']['#value']; ?></p>
                
     <?php if($field_finfull_ambit):?>
     <span><b>Àmbit:</b></span>
     <p><ul>
     <?php foreach($field_finfull_ambit as $ambit): ?>
     <li><?php print $ambit['view']; ?></li>
     <?php endforeach; ?>
     </ul></p>
     <?php endif; ?>
                
     <?php if($field_finfull_tipus[0]['value']):?>
     <span><b>Tipus:</b></span>
     <p><?php print $field_finfull_tipus[0]['value']; ?></p>
     <?php endif; ?>
                
     <?php if($field_finfull_publicprivat[0]['view']):?>
     <span><b>Públic/Privat:</b></span>
     <p><?php print $field_finfull_publicprivat[0]['view']; ?></p>
     <?php endif; ?>
                
     <?php if($field_finfull_ambit_geo[0]['view']):?>
     <span><b>Àmbit geogràfic:</b></span>
     <p><?php print $field_finfull_ambit_geo[0]['view']; ?></p>
     <?php endif; ?>
                
     <?php if($field_finfull_bases):?>
     <span><b>Bases</b></span>
     <p><ul>
     <?php foreach($field_finfull_bases as $base): ?>
     <li><?php print $base['view']; ?></li>
     <?php endforeach; ?>
     </ul></p>
     <?php endif; ?>
</div>
