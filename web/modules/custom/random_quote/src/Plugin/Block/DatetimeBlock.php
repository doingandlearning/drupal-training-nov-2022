<?php

namespace Drupal\random_quote\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a datetime block.
 *
 * @Block(
 *   id = "random_quote_datetime",
 *   admin_label = @Translation("DateTime"),
 *   category = @Translation("Custom")
 * )
 */
class DatetimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $logger;

	/**
	 * DateTime block constructor
	 */
	public function __construct(array $configuration, $plugin_id, $plugin_definition, $logger)
	{
		parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->logger = $logger;
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
      $configuration,
			$plugin_id,
			$plugin_definition,
      $container->get('random_quote.logger.channel.random_quote')
		);
	}
  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'format_string' => 'Y/m/d H:i:s',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['format_string'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Date format string'),
      '#description' => $this->t('Use the PHP formatting strings to display date. The default is Y/m/d H:i:s'),
      '#default_value' => $this->configuration['format_string'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['format_string'] = $form_state->getValue('format_string');
    $this->logger->info('The date string has been updated to @date', ['@date' => $this->configuration['format_string']]);
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $datetime = new \DateTime();
    $formattedDate = $datetime->format($config['format_string']);

    $build['content'] = [
      '#markup' => $formattedDate,  
      '#cache' => ['max-age' => 0]
    ];
    return $build;
  }

}
