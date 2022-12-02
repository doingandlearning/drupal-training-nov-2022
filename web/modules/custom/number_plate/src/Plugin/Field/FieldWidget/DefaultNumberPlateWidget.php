<?php

namespace Drupal\number_plate\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Plugin implementation of the 'default_number_plate_widget'
 * 
 * @FieldWidget(
 *   id = "default_number_plate_widget",
 *   label = @Translation("Default number plate widget"),
 *   field_types = {
 *     "number_plate"
 *   }
 * )
 */
class DefaultNumberPlateWidget extends WidgetBase
{
	use StringTranslationTrait;

	/**
	 * {@inheritdoc}
	 */
	public static function defaultSettings()
	{
		return [
			'number_size' => 5,
			'code_size' => 4,
			'fieldset_state' => 'open',
			'placeholder' => [
				'number' => 'Numbers',
				'code' => 'Letters'
			]
		] + parent::defaultSettings();
	}

	public function settingsForm(array $form, FormStateInterface $form_state)
	{
		$elements = [];

		$elements['number_size'] = [
			'#type' => 'number',
			'#title' => $this->t('Size of the number plate numeric field.'),
			'#default_value' => $this->getSetting('number_size'),
			'#required' => TRUE,
			'#min' => 1,
			'#max' => $this->getFieldSetting('number_max_length')
		];


		$elements['code_size'] = [
			'#type' => 'number',
			'#title' => $this->t('Size of plate code textfield'),
			'#default_value' => $this->getSetting('code_size'),
			'#required' => TRUE,
			'#min' => 1,
			'#max' => $this->getFieldSetting('code_max_length'),
		];

		$elements['fieldset_state'] = [
			'#type' => 'select',
			'#title' => $this->t('Fieldset default state'),
			'#options' => [
				'open' => $this->t('Open'),
				'closed' => $this->t('Closed'),
			],
			'#default_value' => $this->getSetting('fieldset_state'),
			'#description' => $this->t('The default state of the fieldset which contains the two plate fields: open or closed'),
		];

		$elements['placeholder'] = [
			'#type' => 'details',
			'#title' => $this->t('Placeholder'),
			'#description' => $this->t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
		];

		$placeholder_settings = $this->getSetting('placeholder');

		$elements['placeholder']['number'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Number field'),
			'#default_value' => $placeholder_settings['number'],
		];
		$elements['placeholder']['code'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Code field'),
			'#default_value' => $placeholder_settings['code'],
		];

		return $elements;
	}

	public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
	{
		$element['details'] = [
			'#type' => 'details',
			'#title' => $element['#title'],
			'#open' => $this->getSetting('fieldset_state') === 'open' ? TRUE : FALSE,
			'#description' => $element['#description'],
		] + $element;

		$element['details']['code'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Plate code'),
			'#default_value' => isset($items[$delta]->code) ? $items[$delta]->code : NULL,
			'#size' => $this->getSetting('code_size'),
			'#placeholder' => $this->getSetting('placeholder')['code'],
			'#maxlength' => $this->getFieldSetting('code_max_length'),
			'#description' => '',
			'#required' => $element['#required']
		];

		$element['details']['number'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Plate number'),
			'#default_value' => isset($items[$delta]->number) ? $items[$delta]->number : NULL,
			'#size' => $this->getSetting('number_size'),
			'#placeholder' => $this->getSetting('placeholder')['number'],
			'#maxlength' => $this->getFieldSetting('number_max_length'),
			'#description' => '',
			'#required' => $element['#required']
		];

		return $element;
	}

	public function massageFormValues(array $values, array $form, FormStateInterface $form_state ) {
		foreach($values as &$value) {
			$value['number'] = $value['details']['number'];
			$value['code'] = $value['details']['code'];
			unset($value['details']);
		}
		return $values;
	}
}