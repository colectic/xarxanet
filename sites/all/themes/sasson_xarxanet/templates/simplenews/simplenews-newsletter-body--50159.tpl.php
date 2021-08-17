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

$pathroot = 'http://www.xarxanet.org';
$node = $build['#node'];

// Data
$mesos = array('de gener', 'de febrer', 'de març', 'd\'abril', 'de maig', 'de juny', 'de juliol', 'd\'agost', 'de setembre', 'd\'octubre', 'de novembre', 'de desembre');
$dies = array('Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte', 'Diumenge');

// Data Preprocessing


//$Highlight new 1 Section
$highlightnew1ID = $node->field_financ21_notidest1['und'][0]['nid'];
$highlightnew1Node = node_load($highlightnew1ID);
$highlightnew1Title = $highlightnew1Node->title;
$highlightnew1Image = image_style_url('butlleti_quadrada', $highlightnew1Node->field_imatges['und'][0]['uri']);
$highlightnew1ImageAlt = $highlightnew1Node->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
if (empty($highlightnew1Node->field_imatges['und'][0]['uri'])) :
	$highlightnew1Image = image_style_url('butlleti_quadrada', $highlightnew1Node->field_agenda_imatge['und'][0]['uri']);
	$highlightnew1ImageAlt = $highlightnew1Node->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
endif;
$highlightnew1Text = $highlightnew1Node->field_resum['und'][0]['value'];
$highlightnew1Link = url('node/' . $highlightnew1Node->nid, array('absolute' => TRUE));

//$Highlight new 1 Section
$highlightnew2ID = $node->field_financ21_notidest2['und'][0]['nid'];
$highlightnew2Node = node_load($highlightnew2ID);
$highlightnew2Title = $highlightnew2Node->title;
$highlightnew2Image = image_style_url('butlleti_quadrada', $highlightnew2Node->field_imatges['und'][0]['uri']);
$highlightnew2ImageAlt = $highlightnew2Node->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
if (empty($highlightnew2Node->field_imatges['und'][0]['uri'])) :
	$highlightnew2Image = image_style_url('butlleti_quadrada', $highlightnew2Node->field_agenda_imatge['und'][0]['uri']);
	$highlightnew2ImageAlt = $highlightnew2Node->field_imatges['und'][0]['field_file_image_alt_text']['und'][0]['value'];
endif;
$highlightnew2Text = $highlightnew2Node->field_resum['und'][0]['value'];
$highlightnew2Link = url('node/' . $highlightnew2Node->nid, array('absolute' => TRUE));



//Finançaments
$lastweek = $node->created - 604800;
$now = $node->created;
$next_few_days = $now + (5 * 86400);
$query = "SELECT nid FROM `node` WHERE type='financament_full' AND status=1 ORDER BY created DESC";
$nodes = db_query($query);
$financ_nodes = array();
foreach ($nodes as $row) {
	$financ_node = node_load($row->nid);
	$financ_end = strtotime($financ_node->field_date['und'][0][value2]);
	// if (($financ_end > $now) && ($financ_node->created < $now)){ // Condició anterior
	// Nou condicional so·licitat per Marta Fontanals el 13.04.2021 (XARXANET-411)
	// on es demana que hi hagi 4-5 dies de marge ($next_few_days) entre la data de creació del butlletí
	// i la data de fi de convocatòria dels nodes de Finançament que s'hi mostren.
	if (($financ_end > $next_few_days) && ($financ_node->created < $now)) {
		if (($financ_node->created > $lastweek) || (count($financ_nodes) < 15)) {
			$financ_start = strtotime($financ_node->field_date['und'][0][value]);
			$key = $financ_end;
			while (!empty($financ_nodes[$key])) $key++;
			$financ_nodes[$key] = array(
				'title' => $financ_node->title,
				'link' => url('node/' . $financ_node->nid, array('absolute' => TRUE)),
				'teaser' => strip_tags($financ_node->field_resum['und'][0]['value']),
				'convocant' => strip_tags($financ_node->field_convocant['und'][0]['value']),
				'termini' => date('d/m/Y', $financ_start) . ' - ' . date('d/m/Y', $financ_end)
			);
		} else {
			break;
		}
	}
}
ksort($financ_nodes);
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
	table td a:hover{
		text-decoration:none;
	}
</style>
<!-- @END CSS Styles from TOTHOMweb -->
<!-- @END CSS Styles from TOTHOMweb -->
<center id="newsletter" class="wrapper" style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">
	<div class="webkit" style="max-width:602px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;">
		<table class="butlleti" style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 13px; border:1px solid #d3d3d2; border-bottom: 0px; width:100%;">
			<!-- CAPÇALERA -->
			<tr style="background-color:#2f3031;">
				<td style="padding: 0 0 0 5px;">
					<a href="http://www.xarxanet.org" style="text-decoration:none">
						<img src="<?php print $pathroot; ?>/sites/all/themes/xn17/logo.png" alt="logotip xarxanet" style="margin-left:5px; margin-top:20px" />
					</a>
				</td>
				<td>
					<p style="font-size:38px; color:#FFFFFF; text-align:right; font-weight:bold; margin:10px 5px">Finançament</p>
				</td>
			</tr>
			<tr style="background-color:#2f3031; color:#878787; font-weight:bold;">
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
			<tr>
				<td colspan="2" style="padding: 0 15px;">
					<a href="<?php print url('node/' . $node->nid, array('absolute' => TRUE)); ?>" style="background-color:#EDEDED; border-radius:5px; float: right; padding: 5px 10px;">
						Obre al navegador
					</a>		
				</td>
			</tr>
			<?php if (!empty($highlightnew1Node)) : ?>
			<tr>
				<td colspan="2" style="padding: 30px 15px 30px 15px; vertical-align: top; ">
					<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 17px; width:100%;  background-color:#EDEDED; border-radius:15px;">
						<tbody>
							<tr>
								<td style="width: 55%;">
									<table colspan="2">
										<tr>
											<td style="padding:20px 15px 0 20px;">
												<h3 style="font-size:1.25em; font-weight:600; margin-top: 0; margin-bottom:17px;"><?php echo $highlightnew1Title; ?></h3>
												<span style="font-size: .95em; line-height: 1.35em;"><?php echo $highlightnew1Text; ?></span>
											</td>
										</tr>
										<tr>
											<td style="padding:17px 0 20px 20px;">
												<a href="<?php echo $highlightnew1Link; ?>" style="background-color:#BE1622; color:#ffffff; font-size:.93em; padding:14px 16px;float: left; border-radius: 5px; text-decoration:none;">
													Llegiu-ne més
												</a>
											</td>
										</tr>
									</table>
								</td>
								<td style="padding:20px 20px 20px 10px; border-radius: 10px; vertical-align:top;">
									<a href="<?php print $highlightnew1Link; ?>">
										<img src="<?php print $highlightnew1Image; ?>" width="600" alt="<?php print $highlightnew1ImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<?php endif; ?>
			<?php if (!empty($highlightnew2Node)) : ?>
			<tr>
				<td colspan="2" style="padding: 0 15px 50px 15px; vertical-align: top; ">
					<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 17px; width:100%;  background-color:#EDEDED; border-radius:15px;">
						<tbody>
							<tr>
								<td style="width: 55%;">
									<table colspan="2">
										<tr>
											<td style="padding:20px 15px 0 20px;">
												<h3 style="font-size:1.25em; font-weight:600; margin-top: 0; margin-bottom:17px;"><?php echo $highlightnew2Title; ?></h3>
												<span style="font-size: .95em; line-height: 1.35em;"><?php echo $highlightnew2Text; ?></span>
											</td>
										</tr>
										<tr>
											<td style="padding:17px 0 20px 20px;">
												<a href="<?php echo $highlightnew2Link; ?>" style="background-color:#BE1622; color:#ffffff; font-size:.93em; padding:14px 16px;float: left; border-radius: 5px; text-decoration:none;">
													Llegiu-ne més
												</a>
											</td>
										</tr>
									</table>
								</td>
								<td style="padding:20px 20px 20px 10px; border-radius: 10px; vertical-align:top;">
									<a href="<?php print $highlightnew2Link; ?>">
										<img src="<?php print $highlightnew2Image; ?>" width="600" alt="<?php print $highlightnew2ImageAlt; ?>" style="border-width:0;font-family:Fira Sans, Helvetica, Arial !important;width:100%;max-width:600px;height:auto; border-radius:15px;" />
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<?php endif; ?>
			<?php if (!empty($financ_nodes)) : ?>
			<tr>
				<td colspan="2" style="vertical-align: top; background-color:#EDEDED; padding:15px;">
					<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 17px; width:100%;">
						<tr>
							<td colspan="2">
								
								<h2 class="section-title" style="font-family:Fira Sans, Helvetica, Arial !important;font-weight:800;font-size:1.875em !important;color:#333333; margin-top:20px; margin-bottom:25px; color:#BE1622;">Últimes convocatòries</h2>
										
							</td>
						</tr>
						<?php foreach ($financ_nodes as $financ_node) : ?>
							<tr>
								<td>
									<table style="font-family: Fira Sans,Helvetica,Arial,sans-serif; font-size: 16px; width:100%;  background-color:#FFFFFF; border-radius:15px; margin-bottom:25px;">
										<tbody>
											<tr>
												<td style="width: 100%;">
													<table colspan="2">
														<tr>
															<td style="padding:20px 15px 0 20px;">
																<h3 style="font-size:1.25em; font-weight:600; margin-top: 0; margin-bottom:17px;"><?php echo $financ_node['title']; ?></h3>
																<span style="font-size: .95em; line-height: 1.35em; font-style:italic;"><?php echo $financ_node['teaser']; ?></span>				
															</td>
														</tr>
														<tr>
															<td style="padding:5px 15px 0 20px;">
																<span style="font-size: .95em; line-height: 1.35em; font-weight:800;">Convocant: <?php echo $financ_node['convocant']; ?></span>
															</td>
														</tr>
														<tr>
															<td style="padding:5px 15px 0 20px;">
																<span style="font-size: .95em; line-height: 1.35em; font-weight:800;">Termini: <?php echo $financ_node['termini']; ?></span>
															</td>
														</tr>
														<tr>
															<td style="padding:17px 0 20px 20px;">
																<a href="<?php echo $financ_node['link']; ?>" style="background-color:#BE1622; color:#ffffff; font-size:.93em; padding:14px 16px;float: left; border-radius: 5px; text-decoration:none;">
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

						<?php endforeach; ?>
					</table>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<td colspan="2" style="padding:40px 15px;">
					<a href="https://xarxanet.org/financament">
						<table style="background-color:#BE1622; border-radius:14px; width:100%;">
							<tr>
								<td style="font-weight:800; color: #ffffff; font-size:1.68em; padding:70px 0 14px 22px; vertical-align: bottom;">
									Cerca el teu finançament
								</td>
								<td style="color:#ffffff; padding:70px 22px 14px 0; text-align:right; vertical-align:bottom;">
									<img width="50px" src="<?php echo $pathroot; ?>/sites/default/files/search-icon.png" alt="">
								</td>
							</tr>
						</table>
					</a>
				</td>
			</tr>
			<tr>
				<td style="padding:0 15px 30px 15px">
					<a href="https://xarxanet.org/financaments/premis">
						<table style="background-color:#252627; border-radius:14px; padding-right:7px; width:100%;">
							<tr>
								<td style="font-weight:800; color: #ffffff; font-size:1.68em; padding:70px 0 14px 22px;">
									Més premis
								</td>
							</tr>
						</table>
					</a>
				</td>
				<td style="padding:0 15px 30px 15px">
					<a href="https://xarxanet.org/financaments/subvencions">
						<table style="background-color:#252627; border-radius:14px; padding-left:7px; width:100%;">
							<tr>
								<td style="font-weight:800; color: #ffffff; font-size:1.68em; padding:70px 0 14px 22px;">
									Més subvencions
								</td>
							</tr>
						</table>
					</a>
				</td>
			</tr>
			<tr>
				<td style="padding:0 7px 30px 15px">
					<a href="https://twitter.com/ajuts_entitats">
						<img width="270px" src="<?php echo $pathroot; ?>/sites/default/files/banner-twitter-financ.png" alt="Segueix al dia a Twitter @ajuts_entitats">
					</a>
				</td>
				<td style="padding:0 7px 30px 15px">
					<a href="https://xarxanet.org/projectes/noticies/calendari-de-convocatories-de-financament-anuals">
						<img width="270px" src="<?php echo $pathroot; ?>/sites/default/files/banner-cal-financ_2.png" alt="Calendari 2021 - Calendari de convocatòries de finançament anuals 2021">
					</a>
				</td>
			</tr>
			




			
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
							<td style="vertical-align:top; padding-left:10px; padding-top:15px">
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
							<td style="padding:0 0 0 10px">
								<p>
									<a href="https://suport.fundesplai.org/" style="color:white;  font-weight:normal">Suport Tercer Sector – Fundesplai</a><br />
									<a href="http://www.peretarres.org" style="color:white;  font-weight:normal">Fundació Pere Tarrés</a><br />
									<a href="https://www.lavinianext.com/ca/" style="color:white;  font-weight:normal">LaviniaNext</a><br />
									<a href="http://colectic.coop/" style="color:white;  font-weight:normal">Colectic</a><br />
									<a href="http://voluntaris.cat/" style="color:white;  font-weight:normal">Federació Catalana del Voluntariat Social</a><br />
								</p>
							</td>
							<td style="padding:0 0 0 15px"">
								<p>
									<a href="https://www.escoltesiguies.cat/" style="color:white;  font-weight:normal">Minyons Escoltes i Guies de Catalunya</a><br />
									<a href="http://www.tothomweb.com/" style="color:white;  font-weight:normal">TOTHOMweb</a><br />
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
	</div>
</center>