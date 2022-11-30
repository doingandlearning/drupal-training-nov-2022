<?php

namespace Drupal\hello_aurora\Service;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Prepares the greeting.
 */
class GreetingService
{
	use StringTranslationTrait;

	/**
	 * @var \Drupal\Core\Config\ConfigFactoryInterface
	 */
	protected $configFactory;

	/**
	 * GreetingService constructor
	 */
	public function __construct(ConfigFactoryInterface $configFactory) 
	{
		$this->configFactory = $configFactory;
	}

	/**
	 * Return the greeting
	 */
	public function getGreeting() {
		$config = $this->configFactory->get('hello_aurora.custom_greeting');

		$greeting = $config->get('greeting');

		if($greeting !== "" && $greeting)  
		{
			return $greeting;
		}

		$time = new \DateTime();
		$hours = (int) $time->format('G');

		if($hours >= 00 && $hours < 12) {
			return $this->t('Good morning from Aurora');
		}

		if($hours >= 12 && $hours < 18) {
			return $this->t('Good afternoon from Aurora');
		}

		if($hours >= 18) {
			return $this->t('Good evening from Aurora.');
		}
	}
}