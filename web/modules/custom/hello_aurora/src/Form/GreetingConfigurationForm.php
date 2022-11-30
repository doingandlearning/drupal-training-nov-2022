<?php

namespace Drupal\hello_aurora\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Configuration form for the greeting message.
 */
class GreetingConfigurationForm extends ConfigFormBase
{
	/**
	 * {@inheritdoc}
	 */
	protected function getEditableConfigNames() {
		return ['hello_aurora.custom_greeting'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFormId() {
		return 'greeting_configuration_form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		$config = $this->config('hello_aurora.custom_greeting');

		$form['greeting'] = [
			'#type' => 'textfield',
			'#title' => $this->t("Greeting"),
			'#description' => $this->t ('Please provide the greeting you want to use'),
			'#default_value' => $config->get('greeting')
		];

		return parent::buildForm($form, $form_state);
	}

	public function submitForm(array &$form, FormStateInterface $form_state) {
		$this->config('hello_aurora.custom_greeting')
		  ->set('greeting', $form_state->getValue('greeting'))
			->save();
		
			parent::submitForm($form, $form_state);
	}

	public function validateForm(array &$form, FormStateInterface $form_state) {
		$greeting = $form_state->getValue('greeting');

		if(strlen($greeting) > 0 && strlen($greeting) < 5) {
			$form_state->setErrorByName('greeting', $this->t('Could you provide a longer greeting, please.'));
		}
	}
}