<?php

namespace Drupal\hello_aurora\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\hello_aurora\Service\GreetingService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for our greeting.
 */
class HelloAuroraController extends ControllerBase {
	/**
	 * @var \Drupal\hello_aurora\Service\GreetingService
	 */
	protected $greeting;

	/**
	 * HelloAuroraController constructor
	 */
	public function __construct(GreetingService $greeting ) {
		$this->greeting = $greeting;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create(ContainerInterface $container) {
		return new static(
			$container->get('hello_aurora.greeting')
		);
	}

  public function helloAurora() {
		return [
			'#markup' => $this->greeting->getGreeting()
		];
	}
}