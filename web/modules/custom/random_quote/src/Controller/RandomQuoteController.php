<?php

namespace Drupal\random_quote\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\random_quote\Service\QuoteService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for our greeting.
 */
class RandomQuoteController extends ControllerBase {
		/**
	 * @var \Drupal\random_quote\Service\QuoteService
	 */
	protected $quote;

	/**
	 * @var
	 */
	protected $logger;

	/**
	 * RandomQuoteController constructor
	 */
	public function __construct(QuoteService $quote, $logger ) {
		$this->quote = $quote;
		$this->logger = $logger->get('random_quote'); # alt: just $logger
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create(ContainerInterface $container) {
		return new static(
			$container->get('random_quote.quote'),
			$container->get('logger.factory') # alt: random_quote.logger.channel.random_quote
		);
	}

  public function randomQuote() {
		// return new \Symfony\Component\HttpFoundation\RedirectResponse("/node/1");
		// $this->logger->debug("This is a debug message");

		return [
			'#markup' => "<p>" . $this->quote->get_random_quote() . "</p>",
			'#cache' => ['max-age' => 0],
		];
	}

}