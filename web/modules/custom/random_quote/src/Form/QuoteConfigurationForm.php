<?php

namespace Drupal\random_quote\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Configuration form for the random quotes.
 */
class QuoteConfigurationForm extends ConfigFormBase
{
	/**
	 * {@inheritdoc}
	 */
	protected function getEditableConfigNames() {
		return ['random_quote.custom_quotes'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFormId() {
		return 'quote_configuration_form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		$config = $this->config('random_quote.custom_quotes');

		$form['quotes'] = [
			'#type' => 'textarea',
			'#title' => $this->t("Custom Quotes"),
			'#description' => $this->t ('Take a new line for each quote.'),
			'#default_value' => $config->get('quotes') ? implode("\n", $config->get('quotes')) : ""
		];

		return parent::buildForm($form, $form_state);
	}

	public function submitForm(array &$form, FormStateInterface $form_state) {
		$formValues = $form_state->getValue('quotes');
		$arrayValues = explode("\n", $formValues);
	
		$trimmedValues = array_map('trim', $arrayValues );
		
		$this->config('random_quote.custom_quotes')
		  ->set('quotes', $trimmedValues)
			->save();
		
			parent::submitForm($form, $form_state);
	}

}