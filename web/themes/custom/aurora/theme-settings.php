<?php

/**
 * @file
 * Theme settings form for Aurora theme.
 */

/**
 * Implements hook_FORMID_alter()
 * Implements hook_form_system_theme_settings_alter().
 */
function aurora_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['aurora'] = [
    '#type' => 'details',
    '#title' => t('Aurora'),
    '#open' => TRUE,
  ];

  $form['aurora']['font_size'] = [
    '#type' => 'number',
    '#title' => t('Font size'),
    '#min' => 12,
    '#max' => 18,
    '#default_value' => theme_get_setting('font_size'),
  ];

}

function aurora_form_greeting_configuration_form_alter(&$form, &$form_state) {
  $form["hello"] =  [
    '#type' => 'textfield',
    '#title' => "Yo",
    '#description' => "Updated",
    '#default_value' => "17"
  ];
}