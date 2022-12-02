<?php

namespace Drupal\number_place\Plugin\Field\FieldFormatter;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * 
 * @FieldFormatter (
 *   id = "default_number_plate_formatter",
 *   label = @Translation("Default number plate formatter"),
 *   field_types = {
 *     "number_plate"
 *   }
 * )
 */
class DefaultNumberPlateFormatter extends FormatterBase {
	use StringTranslationTrait;

	public function viewElements(FieldItemListInterface $items, $langcode) {
		$elements = [];

		foreach ($items as $delta => $item) {
			$elements[$delta] = $this->viewValue($item);
		}

		return $elements;
	}

	public function viewValue(FieldItemInterface $item) {
		$code = $item->get('code')->getValue();
		$number = $item->get('number')->getValue();
		return [
			'#theme' => 'number_plate',
			'#code' => $code,
			'#number' => $number
		];
	}
}