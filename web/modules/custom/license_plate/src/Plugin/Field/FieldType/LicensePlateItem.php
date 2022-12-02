<?php

namespace Drupal\license_plate\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation for the 'license_plate' field type.
 * 
 * @FieldType (
 *   id = "license_plate",
 *   label = @Translation("License Plate"),
 *   description = @Translation("Field for storing license plates")
 * )
 */
class LicensePlateItem extends FieldItemBase
{
	use StringTranslationTrait;

	/**
	 * {@inheritDoc}
	 */
	public static function defaultStorageSettings()
	{
		return [
			'number_max_length' => 255,
			'code_max_length' => 5
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data)
	{
		$elements = [];

		$elements['number_max_length'] = [
			'#type' => 'number',
			'#title' => $this->t('Plate number maximum length'),
			'#default_value' => $this->getSetting('number_max_length'),
			'#required' => TRUE,
			'#description' => $this->t('Maximum length of the numeric part of the number plate'),
			'#min' => 1,
			'#disabled' => $has_data
		];

		$elements['code_max_length'] = [
			'#type' => 'number',
			'#title' => $this->t('Plate code maximum length'),
			'#default_value' => $this->getSetting('code_max_length'),
			'#required' => TRUE,
			'#description' => $this->t('Maximum length of the non-numeric part of the number plate'),
			'#min' => 1,
			'#disabled' => $has_data
		];

		return $elements + parent::storageSettingsForm($form, $form_state, $has_data);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function schema(FieldStorageDefinitionInterface $field_definition) {
		$schema = [
			'columns' => [
				'number' => [
					'type' => 'varchar',
					'length' => (int) $field_definition->getSetting('number_max_length')
 				],
				'code' => [
					'type' => 'varchar',
					'length' => (int) $field_definition->getSetting('code_max_length')
				]
				]
		];
		return $schema;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
		$properties['number'] = DataDefinition::create('string')->setLabel(t('Plate number'));
		$properties['code'] = DataDefinition::create('string')->setLabel(t('Plate code'));
		return $properties;
	}

	/**
	 * {@inheritdoc}
	 */
}