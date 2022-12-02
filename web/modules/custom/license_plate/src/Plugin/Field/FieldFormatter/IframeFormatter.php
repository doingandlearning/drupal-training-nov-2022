<?php

namespace Drupal\license_plate\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'default_license_plate_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "iframe_field_formatter",
 *   label = @Translation("iFrame field formatter"),
 *   field_types = {
 *     "string"
 *   }
 * )
 */
class IframeFormatter extends FormatterBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'width' => "500",
      'height' => "500"
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      'width' => [
        '#type' => 'textfield',
        '#title' => $this->t('iFrame width'),
        '#default_value' => $this->getSetting('width'),
      ],
      'height' => [
        '#type' => 'textfield',
        '#title' => $this->t('iFrame height'),
        '#default_value' => $this->getSetting('height'),
      ],
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Width: @width, Height: @height', ['@width' =>  $this->getSetting('height'), '@height' => $this->getSetting('height')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $elements[$delta] = $this->viewValue($item);
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return array
   *   The field value render array.
   */
  protected function viewValue(FieldItemInterface $item) {
    
    return [
      '#theme' => 'iframe_container',
      '#url' => $item,
      '#width' => $this->getSetting('width'),
      '#height' => $this->getSetting('width'),
      'cache' => ['max-age' => 1]
    ];
  }

}
