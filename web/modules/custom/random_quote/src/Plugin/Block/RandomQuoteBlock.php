<?php

namespace Drupal\random_quote\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\random_quote\Service\QuoteService;
use Drupal\Core\Form\FormStateInterface;

/**
 * Random Quote block
 * 
 * @Block(
 *   id = "random_quote_block",
 *   admin_label = @Translation("Random Quote Block")
 * )
 */
class RandomQuoteBlock extends BlockBase implements ContainerFactoryPluginInterface
{
	/**
	 * @var \Drupal\random_quote\Service\QuoteService
	 */
	protected $quote;

	/**
	 * RandomQuoteController constructor
	 */
	public function __construct(QuoteService $quote, array $configuration, $plugin_id, $plugin_definition)
	{
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->quote = $quote;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create(
		ContainerInterface $container,
		array $configuration,
		$plugin_id,
		$plugin_definition
	)
	{
		return new static (
			$container->get('random_quote.quote'),
			$configuration,
			$plugin_id,
			$plugin_definition
		);
	}

	public function defaultConfiguration() {
		return [
			'enabled' => 0
		];
	}

	public function blockForm($form, FormStateInterface $form_state) {
		$config = $this->getConfiguration();

		$form['enabled'] = [
			'#type' => 'checkbox',
			'#title' => $this->t("Enabled"),
			'#description' => $this->t('Check this if you want to enable the feature'),
			'#default_value' => $config['enabled']
		];

		return $form;
	}

	public function blockSubmit($form, FormStateInterface $form_state) {
		$this->configuration['enabled'] = $form_state->getValue('enabled');
	}

	/**
	 * {@inheritdoc}
	 */
	public function build() {
		$config = $this->getConfiguration();

		return $config["enabled"] ? [
			'#theme' => 'random_quote_block',
			'#cache' => ['max-age' => 0],
			'#quote' => $this->quote->get_random_quote()
		] : [];
	}
}
