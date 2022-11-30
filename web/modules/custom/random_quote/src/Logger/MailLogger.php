<?php

namespace Drupal\random_quote\Logger;

use Psr\Log\LoggerInterface;
use Drupal\Core\Logger\RfcLoggerTrait;

class MailLogger implements LoggerInterface {
	use RfcLoggerTrait;

	/**
	 * {@inheritdoc}
	 */
	public function log($level, $message, array $context = []) {
    // This is where logging logic will be!
	}
}