<?php

namespace Drupal\random_quote\Logger;

use Drupal\Component\Render\FormattableMarkup;
use Psr\Log\LoggerInterface;
use Drupal\Core\Logger\RfcLoggerTrait;
use Drupal\Core\Logger\RfcLogLevel;
use Drupal\Core\Logger\LogMessageParserInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class MailLogger implements LoggerInterface
{
	use RfcLoggerTrait;

	protected $parser;
	protected $configFactory;

	/**
	 * MailLogger constructor.
	 *
	 * @param \Drupal\Core\Logger\LogMessageParserInterface $parser
	 * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
	 */

	public function __construct(LogMessageParserInterface $parser, ConfigFactoryInterface $configFactory)
	{
		$this->parser = $parser;
		$this->configFactory = $configFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function log($level, $message, array $context = [])
	{
		return;
		if ($level != RfcLogLevel::ERROR) {
			return;
		}

		$to = $this->configFactory->get('system.site')->get('mail');
		$langcode = $this->configFactory->get('system.site')->get('langcode');
		$variables = $this->parser->parseMessagePlaceholders($message, $context);
		$markup = new FormattableMarkup($message, $variables);

		\Drupal::service('plugin.manager.mail')->mail(
			'random_quote',
			'random_quote_log',
			$to,
			$langcode,
			['message' => $markup . $message . $variables . "Looking good here!"]
		);

	}
}