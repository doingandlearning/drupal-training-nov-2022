<?php

namespace Drupal\random_quote\EventSubscriber;

use Drupal\Core\Routing\LocalRedirectResponse;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Drupal\Core\Url;

class RandomQuoteRedirectSubscriber implements EventSubscriberInterface
{

	/**
	 * The current user.
	 * @var AccountProxyInterface
	 */
	protected $currentUser;

	/**
	 * The current route match
	 * @var RouteMatchInterface
	 */
	protected $currentRouteMatch;

	/**
	 */
	public function __construct(AccountProxyInterface $currentUser, RouteMatchInterface $currentRouteMatch)
	{
		$this->currentUser = $currentUser;
		$this->currentRouteMatch = $currentRouteMatch;
	}

	public static function getSubscribedEvents() {
		$events[KernelEvents::REQUEST][] = ['onRequest', 0];
		return $events;
	}

	public function onRequest(GetResponseEvent $event) {
		$request = $event->getRequest();
		$path = $request->getPathInfo();

		if($path != "/random-quote") {
			return;
		}

		$roles = $this->currentUser->getRoles();

		if(in_array("administrator", $roles)) {
			// $url = Url::fromRoute('/admin/config/random-quote-config');
			$event->setResponse(new LocalRedirectResponse('/admin/config/random-quote-config'));
		} else {
			return;
		}
	}
}