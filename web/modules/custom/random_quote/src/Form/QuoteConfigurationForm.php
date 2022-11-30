<?php

namespace Drupal\random_quote\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Logger\LoggerChannelInterface;

/**
 * Configuration form for the random quotes.
 */
class QuoteConfigurationForm extends ConfigFormBase
{
	/**
	 * @var Drupal\Core\Logger\LoggerChannelInterface
	 */
	protected $logger;

	/**
	 * Constructor for the QuoteForm
	 * 
	 * @param Drupal\Core\Config\ConfigFactoryInterface $config_factory
	 * 	The factory for the configuration objects.
	 * @param Drupal\Core\Logger\LoggerChannelInterface $logger
	 *  The logger
	 */
	public function __construct($config_factory, $logger)
	{
		parent::__construct($config_factory);
		$this->logger = $logger;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create(ContainerInterface $container)
	{
		return new static (
			$container->get('config.factory'),
			$container->get('random_quote.logger.channel.random_quote')
		);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getEditableConfigNames()
	{
		return ['random_quote.custom_quotes'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFormId()
	{
		return 'quote_configuration_form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state)
	{
		$config = $this->config('random_quote.custom_quotes');

		$form['quotes'] = [
			'#type' => 'textarea',
			'#title' => $this->t("Custom Quotes"),
			'#description' => $this->t('Take a new line for each quote.'),
			'#default_value' => $config->get('quotes') ? implode("\n", $config->get('quotes')) : ""
		];

		return parent::buildForm($form, $form_state);
	}

	public function submitForm(array &$form, FormStateInterface $form_state)
	{
		$formValues = $form_state->getValue('quotes');
		$arrayValues = explode("\n", $formValues);
		
		$trimmedValues = array_map('trim', $arrayValues);
		$this->logger->info('A new quote was added, they are now @quote.', ['@quote' => $formValues]);
		$this->logger->error("send an error");
		$this->config('random_quote.custom_quotes')
			->set('quotes', $trimmedValues)
			->save();

		parent::submitForm($form, $form_state);
	}

}