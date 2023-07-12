<?php

/**
 * Implements hook_form
 */

function anniversary_settings_form($form, &$form_state) {
  $form['#tree'] = TRUE;

  $help  = '<p>';
  $help .= t('Introduiu el període en qual aquest <em>skin</em> estarà actiu.');
  $help .= '</p>';
  $help .= '<p>';
  $help .= t('Les dates han de seguir el format ISO 8601: <code>YYYY-MM-DD HH:MM</code> <br>Exemple: <em>2023-03-28 09:45</em>');
  $help .= '</p>';

  $form['description'] = array(
    '#type' => 'markup',
    '#markup' => $help,
  );

  $form['start_date'] = array(
    '#type' => 'textfield',
    '#title' => t('Data inici'),
    '#size' => 60,
    '#default_value' => (null !== variable_get('anniversary_start_date') ) ? variable_get('anniversary_start_date') : '',
    '#maxlength' => 128,
    '#required' => TRUE,
  );

  $form['end_date'] = array(
    '#type' => 'textfield',
    '#title' => t('Data final'),
    '#size' => 60,
    '#default_value' => (null !== variable_get('anniversary_end_date') ) ? variable_get('anniversary_end_date') : '',
    '#maxlength' => 128,
    '#required' => TRUE,
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Actualitzar canvis'),
    '#id' => 'submit',
  );

  return $form;
}

/**
 * Implements hook_form_validate
 */

function anniversary_settings_form_validate($form, &$form_state) {
  $values = $form_state['values'];
  // 'Update feeds' submit validation handler
  if ($form_state['clicked_button']['#id'] == 'submit') {
    if (!validateDate($values['start_date'])) {
      form_set_error('start_date', t('El format de la Data d\'inici és incorrecte.'));
    }
    if (!validateDate($values['end_date'])) {
      form_set_error('end_date', t('El format de la Data final és incorrecte.'));
    }
  }
}

function validateDate($date, $format = 'Y-m-d H:i'){
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
}

/**
 * Implements hook_form_submit
 */
function anniversary_settings_form_submit($form, &$form_state) {
  $values = $form_state['values'];
  // 'Update feeds' submit handler
  if ($form_state['clicked_button']['#id'] == 'submit') {
    variable_set('anniversary_start_date', $values['start_date']);
    variable_set('anniversary_end_date', $values['end_date']);
    drupal_set_message(t('La configuració s\'ha guardat correctament.'));
  }
}
