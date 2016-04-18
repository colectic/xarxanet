<?php
// $Id: theme-settings.php,v 1.6 2008/09/15 09:59:03 johnalbin Exp $

// Include the definition of xarxanet_theme_get_default_settings().
include_once './' . drupal_get_path('theme', 'xarxanet') . '/template.theme-registry.inc';


/**
 * Implementation of THEMEHOOK_settings() function.
 *
 * @param $saved_settings
 *   An array of saved settings for this theme.
 * @param $subtheme_defaults
 *   Allow a subtheme to override the default values.
 * @return
 *   A form array.
 */
function xarxanet_settings($saved_settings, $subtheme_defaults = array()) {

  // Add the form's CSS
  drupal_add_css(drupal_get_path('theme', 'xarxanet') . '/theme-settings.css', 'theme');

  // Add javascript to show/hide optional settings
  drupal_add_js(drupal_get_path('theme', 'xarxanet') . '/theme-settings.js', 'theme');

  // Get the default values from the .info file.
  $defaults = xarxanet_theme_get_default_settings('xarxanet');

  // Allow a subtheme to override the default values.
  $defaults = array_merge($defaults, $subtheme_defaults);

  // Merge the saved variables and their default values.
  $settings = array_merge($defaults, $saved_settings);

  /*
   * Create the form using Forms API
   */
  $form['xarxanet-div-opening'] = array(
    '#value'         => '<div id="xarxanet-settings">',
  );

  $form['xarxanet_block_editing'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Show block editing on hover'),
    '#description'   => t('When hovering over a block, privileged users will see block editing links.'),
    '#default_value' => $settings['xarxanet_block_editing'],
  );

  $form['breadcrumb'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Breadcrumb settings'),
    '#attributes'    => array('id' => 'xarxanet-breadcrumb'),
  );
  $form['breadcrumb']['xarxanet_breadcrumb'] = array(
    '#type'          => 'select',
    '#title'         => t('Display breadcrumb'),
    '#default_value' => $settings['xarxanet_breadcrumb'],
    '#options'       => array(
                          'yes'   => t('Yes'),
                          'admin' => t('Only in admin section'),
                          'no'    => t('No'),
                        ),
  );
  $form['breadcrumb']['xarxanet_breadcrumb_separator'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Breadcrumb separator'),
    '#description'   => t('Text only. Don’t forget to include spaces.'),
    '#default_value' => $settings['xarxanet_breadcrumb_separator'],
    '#size'          => 5,
    '#maxlength'     => 10,
    '#prefix'        => '<div id="div-xarxanet-breadcrumb-collapse">', // jquery hook to show/hide optional widgets
  );
  $form['breadcrumb']['xarxanet_breadcrumb_home'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Show home page link in breadcrumb'),
    '#default_value' => $settings['xarxanet_breadcrumb_home'],
  );
  $form['breadcrumb']['xarxanet_breadcrumb_trailing'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Append a separator to the end of the breadcrumb'),
    '#default_value' => $settings['xarxanet_breadcrumb_trailing'],
    '#description'   => t('Useful when the breadcrumb is placed just before the title.'),
  );
  $form['breadcrumb']['xarxanet_breadcrumb_title'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Append the content title to the end of the breadcrumb'),
    '#default_value' => $settings['xarxanet_breadcrumb_title'],
    '#description'   => t('Useful when the breadcrumb is not placed just before the title.'),
    '#suffix'        => '</div>', // #div-xarxanet-breadcrumb
  );

  $form['themedev'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Theme development settings'),
    '#attributes'    => array('id' => 'xarxanet-themedev'),
  );
  $form['themedev']['xarxanet_rebuild_registry'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Rebuild theme registry on every page.'),
    '#default_value' => $settings['xarxanet_rebuild_registry'],
    '#description'   => t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'http://drupal.org/node/173880#theme-registry')),
    '#prefix'        => '<div id="div-xarxanet-registry"><strong>' . t('Theme registry:') . '</strong>',
    '#suffix'        => '</div>',
  );
  $form['themedev']['xarxanet_layout'] = array(
    '#type'          => 'radios',
    '#title'         => t('Layout method'),
    '#options'       => array(
                          'border-politics-liquid' => t('Liquid layout') . ' <small>(layout-liquid.css)</small>',
                          'border-politics-fixed' => t('Fixed layout') . ' <small>(layout-fixed.css)</small>',
                        ),
    '#default_value' => $settings['xarxanet_layout'],
  );
  $form['themedev']['xarxanet_wireframes'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Display borders around main layout elements'),
    '#default_value' => $settings['xarxanet_wireframes'],
    '#description'   => t('<a href="!link">Wireframes</a> are useful when prototyping a website.', array('!link' => 'http://www.boxesandarrows.com/view/html_wireframes_and_prototypes_all_gain_and_no_pain')),
    '#prefix'        => '<div id="div-xarxanet-wireframes"><strong>' . t('Wireframes:') . '</strong>',
    '#suffix'        => '</div>',
  );

  $form['xarxanet-div-closing'] = array(
    '#value'         => '</div>',
  );

  // Return the form
  return $form;
}
