<?php
/**
 * @file
 * Views definitions for omrop_hack module.
 */
/**
 * Implements hook_views_data().
 */
function views_password_views_data() {
  $data['user']['table']['group'] = t('User');
  $data['user']['table']['join'] = array(
    '#global' => array(),
  );
  $data['user']['user_password'] = array(
    'title' => t('Password hash'),
    'help' => t('Get the password hash for the user.'),
    'field' => array(
      'handler' => 'views_password_handler_password',
    ),
  );
  return $data;
}
