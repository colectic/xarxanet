<?php 

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

// Data
$mesos = array('de gener', 'de febrer', 'de març', 'd\'abril', 'de maig', 'de juny', 'de juliol', 'd\'agost', 'de setembre', 'd\'octubre', 'de novembre', 'de desembre');
$dies = array('Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte', 'Diumenge');
$pathroot = 'http://www.xarxanet.org';
$node = $build['#node'];


// Data Preprocessing

//$Monographic Section
$monographicSectTitle = $node->field__actualitat21_mono_epigraf['und'][0]['value'];
$monographicImage = image_style_url('large', $node->field_actualitat21_mono_imatge['und'][0]['uri']);
$monographicImageAlt = $node->field_actualitat21_mono_imatge['und'][0]['field_file_image_alt_text']['und'][0]['value'];
$monographicText = $node->field_actualitat21_mono_cos['und'][0]['value'];
$monographicLink = "https://www.xarxanet.org";

//$entity Section
$entityID = $node->field_actualitat21_entitat['und'][0]['nid'];
$entityNode = node_load($entityID);
$entityTitle = $entityNode->title;
$entityImage = image_style_url('butlleti_quadrada', $entityNode->field_imatges['und'][0]['uri']);
$entityImageAlt = $entityNode->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
$entityText = strip_tags($entityNode->field_resum['und'][0]['value']);
$entityLink = url('node/' . $entityNode->nid, array('absolute' => TRUE));

//$highlight Section
$highlightID = $node->field_actualitat21_destaquem['und'][0]['nid'];
$highlightNode = node_load($highlightID);
$highlightTitle = $highlightNode->title;
$highlightImage = image_style_url('butlleti_quadrada', $highlightNode->field_imatges['und'][0]['uri']);
$highlightImageAlt = $highlightNode->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
$highlightText = strip_tags($highlightNode->field_resum['und'][0]['value']);
$highlightLink = url('node/' . $highlightNode->nid, array('absolute' => TRUE));

//Resource Section
$resourceID = $node->field_actualitat21_recurs['und'][0]['nid'];
$resourceNode = node_load($resourceID);
$resourceTitle = $resourceNode->title;
$resourceImage = image_style_url('butlleti_quadrada', $resourceNode->field_imatges['und'][0]['uri']);
$resourceImageAlt = $resourceNode->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
$resourceText = strip_tags($resourceNode->field_resum['und'][0]['value']);
$resourceLink = url('node/' . $resourceNode->nid, array('absolute' => TRUE));

//contrast1 Section
$contrast1ID = $node->field_actualitat21_noticontrast1['und'][0]['nid'];
$contrast1Node = node_load($contrast1ID);
$contrast1Title = $contrast1Node->title;
$contrast1Image = image_style_url('butlleti_quadrada', $contrast1Node->field_imatges['und'][0]['uri']);
$contrast1ImageAlt = $contrast1Node->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
$contrast1Text = $contrast1Node->field_resum['und'][0]['value'];
$contrast1Link = url('node/' . $contrast1Node->nid, array('absolute' => TRUE));

//contrast2 Section
$contrast2ID = $node->field_actualitat21_noticontrast2['und'][0]['nid'];
$contrast2Node = node_load($contrast2ID);
$contrast2Title = $contrast2Node->title;
$contrast2Image = image_style_url('butlleti_quadrada', $contrast2Node->field_imatges['und'][0]['uri']);
$contrast2ImageAlt = $contrast2Node->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
$contrast2Text = $contrast2Node->field_resum['und'][0]['value'];
$contrast2Link = url('node/' . $contrast2Node->nid, array('absolute' => TRUE));

// echo '<pre>';
// echo var_dump($monographicNode);
// echo '</pre>';


?>

<!-- CSS Styles from TOTHOMweb -->
<style type="text/css">
	#main #content {
		background-color: #ffffff;
	}

	tbody {
		border: 0px;
	}

	table,
	table td,
	table tr {
		border-spacing: 0px !important;
		border-collapse: collapse !important;
		padding: 0px;
	}

	table td {
		border-top: 0px;
	}

	@media (max-width: 414px) {
		.noticia-hznt td{
			width:100%;
		}
	}
	@media (max-width: 500px) {
		tr.capcalera-top td{
			display:block;
            
		}
        tr.capcalera-top td p{
			text-align:left!important;
            padding-left:5px;
            
		}
           
	}
</style>
<!--[if gte mso 7]><xml>
  <o:OfficeDocumentSettings>
  <o:AllowPNG/>
  <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml><![endif]-->
<!-- @END CSS Styles from TOTHOMweb -->
<center class="wrapper" style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">
	<!--[if (gte mso 9)|(IE)]>
		<table width="600" align="center" style="border-spacing:0;font-family:sans-serif;color:#333333;">
		<tr>
		<td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">
	<![endif]-->
	<table class="outer" align="center" style="border-spacing:0;font-family:sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:602px;border-width:1px;border-style:solid;border-color:#dddddd;">
		<tr>
			<td>
				<table>
					<tr>
						<td colspan="2" style="text-align:center; padding:0 0 10px 0;">
							<a href="<?php print url('node/' . $node->nid, array('absolute' => TRUE)); ?>" style="color:#000000;">
								Obre al navegador
							</a>
						</td>
					</tr>
				</table>		
			</td>
		</tr>
		<tr>
			<td>
				<table class="butlleti" style="background-color:#2f3031;font-family: Fira Sans,Helvetica,Arial,sans-serif; border-spacing:0; margin:0 auto; width:100%;max-width:602px; font-size: 13px; border-bottom: 0px; width:100%;">
					<!-- CAPÇALERA -->
					<tr class="capcalera-top">
						<td style="padding: 0 0 0 5px; min-height:40%;">
							<a href="http://www.xarxanet.org" style="text-decoration:none">
								<img src="<?php print $pathroot; ?>/sites/all/themes/xn17/logo.png" alt="Xarxanet" style="margin-left:5px; margin-top:20px" />
							</a>
						</td>
						<td>
							<p style="font-size:30px; color:#FFFFFF; text-align:right; font-weight:bold; margin:10px 5px">Actualitat</p>
						</td>
					</tr>
					<tr style="color:#878787; font-weight:bold;">
						<td style="padding: 5px 10px; border-top:3px solid #231f20; border-bottom: 15px solid white;">
							<?php
							$created = $node->created;
							echo $dies[date('N', $created) - 1] . ', ' . date('j', $created) . ' ' . $mesos[date('n', $created) - 1] . ' de ' . date('Y', $created) . ' - Num. ' . $title;
							?>
						</td>
						<td style="text-align: right; padding: 5px 10px; border-top:3px solid #231f20; border-bottom: 15px solid white;">
							<a href="http://www.xarxanet.org/hemeroteca_actualitat" style=" color:#878787">Butlletins anteriors</a>
						</td>
					</tr>
				</table>
				<table class="butlleti" style="font-family: Fira Sans,Helvetica,Arial,sans-serif; border-spacing:0; margin:0 auto; width:100%;max-width:602px; font-size: 13px; border-bottom: 0px; width:100%;">
					<tr>
						<td colspan="2" style="padding:0 10px;vertical-align: top; text-align:right">
							<p style="margin:0;font-size:14px;color:#2f3031;;">ISSN 2696-9750</p>
						</td>
					</tr>
					<?php if (!empty($monographicSectTitle)) : ?>
					<tr>
						<td colspan="2" style="padding:0 15px;">
							<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;">
								<tbody>
									<tr>
										<td>
											<h2 class="section-title" style="font-family:Fira Sans, Helvetica, Arial !important;font-weight:600;font-size:1.875em !important;color:#333333;margin-top:20px; margin-bottom:25px; "><?php echo $monographicSectTitle; ?></h2>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding:0 15px 20px 15px;">
							<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%; background-color:#EDEDED; border-radius:15px;">
								<tbody>
									<tr>
										<td colspan="2" style="padding:10px;">
											<a href="<?php print $monographicLink; ?>">
												<img src="<?php print $monographicImage; ?>" width="600" alt="<?php print $monographicImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
											</a>
										</td>
									</tr>
									<tr>

										<td style="padding:10px 20px 20px 20px; width: 65%; color:#333333;">
											<p style="font-size: 14px; line-height: 1.22em; margin:0;"><?php echo $monographicText; ?></p>
										</td>
										<td style="padding: 17px 15px 20px 0; vertical-align:bottom;">
											<a href="<?php echo $monographicLink; ?>" style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; background-color:#BE1622; color:#ffffff; font-size:.93em; border:15px solid #BE1622; float: right; border-radius: 5px; text-decoration:none;">
												Llegiu-ne més
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php endif; ?>
					<!-- SECTION  || L'entitat protagonista -->
					<?php if (!empty($entityNode)) : ?>
					<tr>
						<td colspan="2" style="padding: 0 15px;">
							<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;">
								<tbody>
									<tr>
										<td>
											<h2 class="section-title" style="font-family:Fira Sans, Helvetica, Arial !important;font-weight:600;font-size:1.875em !important;color:#333333; margin-top:20px; margin-bottom:25px;">L'entitat protagonista</h2>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding: 0 15px 20px 15px; vertical-align: top; ">
							<table class="noticia-hznt" style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;  background-color:#EDEDED; border-radius:15px;">
								<tbody>
									<tr>
										<td style="width: 55%;">
											<table colspan="2">
												<tr>
													<td style="padding:20px 15px 0 20px; color:#333333;">
														<h3 style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; line-height:1.3em; font-size:1.25em; font-weight:600; margin-top: 0; margin-bottom:17px;"><?php echo $entityTitle; ?></h3>
														<p style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important;font-size: 14px; line-height: 1.22em; margin:15px 0 0 0;"><?php echo $entityText; ?></p>
													</td>
												</tr>
												<tr>
													<td style="padding:17px 0 20px 20px;">
														<a href="<?php echo $entityLink; ?>" style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; background-color:#BE1622; color:#ffffff; font-size:.93em; border:15px solid #BE1622;float: left; border-radius: 5px; text-decoration:none;">
															Llegiu-ne més
														</a>
													</td>
												</tr>
											</table>
										</td>
										<td style="padding:20px 20px 20px 10px; border-radius: 10px; vertical-align:top;">
											<a href="<?php print $entityLink; ?>">
												 <!--[if (gte mso 9)|(IE)]>
												<img src="<?php print $entityImage; ?>" width="250" alt="<?php print $entityImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
												<div style="display:none">
												<![endif]-->
													<img src="<?php print $entityImage; ?>" width="600" alt="<?php print $entityImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
												<!--[if mso]>
                                                   </div>
                                               <![endif]-->
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php endif; ?>
					<!-- SECTION  || Destaquem-->
					<?php if (!empty($highlightNode)) : ?>
					<tr>
						<td colspan="2" style="padding: 0 15px;">
							<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;">
								<tbody>
									<tr>
										<td>
											<h2 class="section-title" style="font-family:Fira Sans, Helvetica, Arial !important;font-weight:600;font-size:1.875em !important;color:#333333; margin-top:20px; margin-bottom:25px;">Destaquem</h2>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding:0 15px 20px 15px; vertical-align: top;">
							<table class="noticia-hznt" style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;  background-color:#EDEDED; border-radius:15px;">
								<tbody>
									<tr>
										<td style="padding:20px 10px 20px 20px; border-radius: 10px; vertical-align:top;">
											<a href="<?php print $highlightLink; ?>">
												<!--[if (gte mso 9)|(IE)]>
												<img src="<?php print $highlightImage; ?>" width="250" alt="<?php print $highlightImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
												<div style="display:none">
												<![endif]-->
												<img src="<?php print $highlightImage; ?>" width="600" alt="<?php print $highlightImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
												<!--[if mso]>
                                                   </div>
                                               <![endif]-->
											</a>
										</td>
										<td style="width: 55%;">
											<table colspan="2">
												<tr>
													<td style="padding:20px 20px 0 15px; color:#333333;">
														<h3 style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; line-height:1.3em; font-size:1.25em; font-weight:600; margin-top: 0; margin-bottom:17px;"><?php echo $highlightTitle; ?></h3>
														<p style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; font-size: 14px; line-height: 1.22em; margin:15px 0 0 0;"><?php echo $highlightText; ?></p>
													</td>
												</tr>
												<tr>
													<td style="padding:17px 0 20px 15px;">
														<a href="<?php echo $highlightLink; ?>" style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; background-color:#BE1622; color:#ffffff; font-size:.93em; border:15px solid #BE1622;float: left; border-radius: 5px; text-decoration:none;">
															Llegiu-ne més
														</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php endif; ?>
					<!-- SECTION  || El recurs de la setmana -->
					<?php if (!empty($resourceNode)) : ?>
					<tr>
						<td colspan="2" style="padding:0 15px;">
							<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;">
								<tbody>
									<tr>
										<td>
											<h2 class="section-title" style="font-family:Fira Sans, Helvetica, Arial !important;font-weight:600;font-size:1.875em !important;color:#333333; margin-top:20px; margin-bottom:25px;">El recurs de la setmana</h2>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding: 0 15px 20px 15px; vertical-align: top;">
							<table class="noticia-hznt" style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;  background-color:#EDEDED; border-radius:15px;">
								<tbody>
									<tr>
										<td style="width: 55%;">
											<table colspan="2">
												<tr>
													<td style="padding: 20px 15px 0 20px; color:#333333;">
														<h3 style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; line-height:1.3em; font-size:1.25em; font-weight:600; margin-top: 0; margin-bottom:17px;"><?php echo $resourceTitle; ?></h3>
														<p style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; font-size: 14px; line-height: 1.22em; margin:15px 0 0 0;"><?php echo $resourceText; ?></p>
													</td>
												</tr>
												<tr>
													<td style="padding:17px 0 20px 20px;">
														<a href="<?php echo $resourceLink; ?>" style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; background-color:#BE1622; color:#ffffff; font-size:.93em; border:15px solid #BE1622;float: left; border-radius: 5px; text-decoration:none;">
															Llegiu-ne més
														</a>
													</td>
												</tr>
											</table>
										</td>
										<td style="padding:20px 20px 20px 10px;border-radius: 10px; vertical-align:top;">
											<a href="<?php print $resourceLink; ?>">
											<!--[if (gte mso 9)|(IE)]>
												<img src="<?php print $resourceImage; ?>" width="250" alt="<?php print $resourceImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
												<div style="display:none">
												<![endif]-->
												<img src="<?php print $resourceImage; ?>" width="600" alt="<?php print $resourceImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
											<!--[if mso]>
                                                   </div>
                                               <![endif]-->
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<?php endif; ?>
					<!-- SECTION  || Contrastos -->
					<?php if (!empty($contrast1Node)) : ?>
					<tr>
						<td colspan="2" style="padding: 0 15px;">
							<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;">
								<tbody>
									<tr>
										<td>
											<h2 class="section-title" style="font-family:Fira Sans, Helvetica, Arial !important;font-weight:600;font-size:1.875em !important;color:#333333; margin-top:20px; margin-bottom:25px;">Contrastos</h2>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td style="width:50%; max-width:50%; padding:0 8px 40px 15px; vertical-align:top;">
							<table style="font-size:16px; background-color:#ADF08F; border-radius:15px; min-height: 420px; display:block;">
								<tr>
									<td colspan="2" style="padding:12px; vertical-align:top;">
										<a href="<?php print $contrast1Link; ?>" style="display:block;">
										
											<img src="<?php print $contrast1Image; ?>" width="100%" alt="<?php print $contrast1ImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;height:auto; border-radius:15px;" />
										</a>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="padding: 0 10px; vertical-align:top;">
										<a href="<?php print $contrast1Link; ?>" style="text-decoration:none; color:#333333; display:block;">			
											<h3 style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; font-size:1.25em; line-height:1.25em; font-weight:600; margin-top: 0; margin-bottom:17px;color:#333333;"><?php echo $contrast1Title; ?></h3>
										</a>
									</td>
								</tr>
							</table>
						</td>
						<?php if (!empty($contrast2Node)) : ?>
						<td style="width:50%; max-width:50%; padding:0 15px 40px 8px; vertical-align:top;">
							<table style="font-size:16px; background-color:#FF5561; border-radius:15px; min-height: 420px; display:block;">
								<tr>
									<td colspan="2" style="padding:12px; vertical-align:top;">
										<a href="<?php print $contrast2Link; ?>" style="display:block;">
											<img src="<?php print $contrast2Image; ?>" width="100%" alt="<?php print $contrast2ImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;;height:auto; border-radius:15px;" />
										</a>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="padding:0 10px; vertical-align:top;">
										<a href="<?php print $contrast2Link; ?>" style="text-decoration:none; color:#333333; display:block;">			
											<h3 style="font-family:Fira Sans,Helvetica,Arial,sans-serif!important; font-size:1.25em; line-height:1.25em; font-weight:600; margin-top: 0; margin-bottom:17px;color:#333333;"><?php echo $contrast2Title; ?></h3>
										</a>
									</td>
								</tr>
							</table>
						</td>
						<?php endif; ?>
						
					</tr>
					<?php endif; ?>
					<!-- END CONTENT -->
					<!-- PEU -->
					<tr style="background-color:#2f3031;">
						<td colspan="2" style="padding: 4px;">
							<table class="butlleti" style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 13px; color:white;">
								<tr class='body'>
									<td colspan="2" style="padding: 10px 0 0 10px;">
										<strong>Xarxanet.org és un projecte de</strong>
									</td>
									<td colspan="2" style="padding: 10px 0 0 10px;">
										<strong>Entitats promotores</strong>
									</td>
								</tr>
								<tr class='body'>
									<td style="vertical-align:top; padding:15px 0 0 15px;">
										<table class="butlleti">
											<tr class='body'>
												<td>
													<a href="http://benestar.gencat.cat" style="text-decoration:none">
														<img alt="logo generalitat" src="<?php echo $pathroot ?>/sites/default/files/butlletins/financament/logo_generalitat.png">
													</a>
												</td>
											</tr>
											<tr class='body'>
												<td style="height: 55px; vertical-align: bottom;">
													<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/es/deed.ca" rel="license">
														<img style="border:0 none;" src="http://i.creativecommons.org/l/by-nc-sa/3.0/es/80x15.png" alt="Licencia de Creative Commons">
													</a>
												</td>
											</tr>
										</table>
									</td>
									<td style="vertical-align:top; padding-top:15px">
										<!-- <a href="http://www.voluntariat.org" style="text-decoration:none">
												<img alt="logo voluntariat" src="<?php echo $pathroot ?>/sites/default/files/butlletins/financament/logo_scv.png">
											</a> -->
									</td>
									<td style="padding: 0 0 0 10px;">
										<p>
											<a href="https://suport.fundesplai.org/" style="color:white;  font-weight:normal">Suport Tercer Sector – Fundesplai</a><br />
											<a href="http://www.peretarres.org" style="color:white;  font-weight:normal">Fundació Pere Tarrés</a><br />
											<a href="https://www.lavinianext.com/ca/" style="color:white;  font-weight:normal">LaviniaNext</a><br />
											<a href="http://colectic.coop/" style="color:white;  font-weight:normal">Colectic</a><br />
											<a href="https://www.xadica.cat/" style="color:white;  font-weight:normal">Xarxa Digital Catalana</a><br />
										</p>
									</td>
									<td style="padding:0 0 0 15px;">
										<p>
											<a href="https://www.escoltesiguies.cat/" style="color:white;  font-weight:normal">Minyons Escoltes i Guies de Catalunya</a><br />
											<a href="https://www.tothomweb.com/" style="color:white;  font-weight:normal">TOTHOMweb</a><br />
											<a href="https://www.kiwop.com/" style="color:white;  font-weight:normal">Kiwop</a><br />
										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class='body'>
						<td colspan="2" style="background-color:#231f20; color:white; text-align:right; padding:5px 10px;">
							<a style=" color:white" href="http://www.xarxanet.org/alta_actualitat">Alta</a> |
							<a style=" color:white;" href="http://www.xarxanet.org/baixa_actualitat">Baixa</a> |
							<a style=" color:white;" href="mailto:butlleti@xarxanet.org?Subject=Consulta%20butlletí">Contacte</a> |
							<a style=" color:white;" href="http://web.gencat.cat/ca/menu-ajuda/ajuda/avis_legal/">Avís legal</a>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="background-color:black; color:white; text-align:right; padding:5px 10px; font-size: 0.75em;">
							<p>
								<a style="text-decoration: underline; color:white;" href="http://web.gencat.cat/ca/menu-ajuda/ajuda/avis_legal/">Avís legal</a>: D’acord amb l’article 17.1 de la Llei 19/2014, la &copy;Generalitat de Catalunya permet la reutilització dels continguts i de les dades sempre que se'n citi la font i la data d'actualització i que no es desnaturalitzi la informació (article 8 de la Llei 37/2007) i també que no es contradigui amb una llicència específica. Si l'adreça de correu que informeu al donar-vos d'alta deixa d'estar activa us donarem de baixa a la base de dades. <br />Aquest butlletí és una iniciativa del Departament de Drets Socials de la Generalitat de Catalunya, coeditat amb la Fundació Pere Tarrés.
							</p>
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
	
</center>