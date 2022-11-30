<?php

namespace Drupal\random_quote\Service;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Prepares the greeting.
 */
class QuoteService
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
	public function get_random_quote() {
		$config = $this->configFactory->get('random_quote.custom_quotes');

		$customQuotes = $config->get('quotes');

		$this->quotes = array_merge($customQuotes, $this->quotes);
		return $this->quotes[random_int(0, count($this->quotes) - 1)];
	}

	protected $quotes = [
		"“Measuring programming progress by lines of code is like measuring aircraft building progress by weight.” -- Bill Gates",
		"“Code is read more than it is written.” -- Daniel Roy Greenfeld",
		"“People tend to think of the web as a way to get information or perhaps as a place to carry out ecommerce. But really, the web is about accessing applications. Think of each website as an application, and every single click, every single interaction with that site, is an opportunity to be on the very latest version of that application.” -- Marc Andreessen",
		"“Google Analytics is the best friend of all Digital Marketers as it dictates the decision making and success of every website.” -- Dr. Chris Dayagdag",
		"“If debugging is the process of removing software bugs, then programming must be the process of putting them in.” -- Edsger Dijkstra",
		"“Things aren’t always #000000 and #FFFFFF.” -- HTML Proverb",
		"“Search Engine Optimization is no longer about stuffing keywords and attempting to trick Google into ranking your website. It’s about creating a user experience that is data driven. We know what customers are searching for and we know how to get them to a page. It’s a combination of science and art to successfully rank a website.” -- Leland Dieno",
		"“A designer knows he has achieved perfection not when there is nothing left to add, but when there is nothing left to take away.” -- Antoine de Saint-Exupéry",
		"“I don’t care if it works on your machine! We are not shipping your machine!” -- Vidiu Platon",
		"“The public is more familiar with bad design than good design. It is, in effect, conditioned to prefer bad design, because that is what it lives with. The new becomes threatening, the old reassuring.” -- Paul Rand",
		"“Websites promote you 24/7: No employee will do that.” -- Paul Cookson",
		"“Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you live.” -- Martin Golding",
		"“Learning HTML and CSS is a lot more challenging than it used to be. Responsive web design adds more layers of complexity to design and develop websites.” -- Jacob Lett",
		"“One man’s crappy software is another man’s full time job.” -- Jessica Gaston",
		"“A successful website does three things: It attracts the right kinds of visitors. Guides them to the main services or product you offer. Collect Contact details for future ongoing relation.” -- Mohamed Saad",
		"“Writing the first 90 percent of a computer program takes 90 percent of the time. The remaining ten percent also takes 90 percent of the time and the final touches also take 90 percent of the time.” -- N.J. Rubenking",
		"“If there’s one thing you learn by working on a lot of different Web sites, it’s that almost any design idea–no matter how appallingly bad–can be made usable in the right circumstances, with enough effort.” -- Steve Krug",
		"“No one comes to your website to be entertained. They have questions they think you can answer. Content answers questions.” -- Jay Baer",
		"“Sometimes it pays to stay in bed on Monday, rather than spending the rest of the week debugging Monday’s code.” -- Dan Salomon",
		"“An individual block of code takes moments to write, minutes or hours to debug, and can last forever without being touched again. It’s when you or someone else visits code written yesterday or ten years ago that having code written in a clear, consistent style becomes extremely useful. Understandable code frees mental bandwidth from having to puzzle out inconsistencies, making it easier to maintain and enhance projects of all sizes.” -- Daniel Roy Greenfeld",
		"“Digital design is like painting, except the paint never dries.” -- Neville Brody",
		"“Don’t make me think.” -- Steve Krug",
		"“Let us take you into a deeper experience, make a moment a lasting conveyable memory. Let us help build your tribe.” -- Deep Immersion",
		"“Most sites need to prevent breadth — many many pages that are organized cohesively. A site that presents a single webpage is unlikely to present sufficient depth of content to justify extensive SEO.” -- Harold Davis",
		"“Writing the first 90 percent of a computer program takes 90 percent of the time. The remaining ten percent also takes 90 percent of the time and the final touches also take 90 percent of the time.” -- N.J. Rubenking",
		"“There are three responses to a piece of design — yes, no, and WOW! Wow is the one to aim for.” -- Milton Glaser",
		"“Any code of your own that you haven’t looked at for six or more months might as well have been written by someone else.” -- Eagleson’s Law",
		"“A website without SEO is like a car with no gas.” -- Paul Cookson",
		"“Remember, the web isn’t about control. If a visitor to your site is familiar with using a browser’s native form doodad, you won’t be doing them any favors if you override the browser functionality with your own widget, even if you think your widget looks better.” -- Jeremy Keith",
		"“The user experience design of a product essentially lies between the intentions of the product and the characteristics of your user.” -- David Kadavy",
		"“If you want a great site, you’ve got to test. After you’ve worked on a site for even a few weeks, you can’t see it freshly anymore. You know too much. The only way to find out if it really works is to test it.” -- Steve Krug",
		"“Design doesn’t mean that every person [is] gonna like, love it, but that’s the creativity of [an] eye which creates something different.” -- Bijay Chhetri",
		"“Responsive Web Design always plays important role whenever going to promote your website.” -- Josh Wilson",
		"“Software always remains softly for End users! But sometimes hardly to developers!” -- Mohamed Saad",
		"“Your website is the center of your digital ecosystem, like a brick and mortar location, the experience matters once a customer enters, just as much as the perception they have of you before they walk through the door.” -- Leland Dieno",
		"“Don’t forget: when you start a website, it’s not yet a trusted site. So you have to bring people from a trusted site to your site to build up the trust in your site.” -- James Altucher",
		"“Creating your own portfolio takes time. First you have to choose the technologies among the overwhelming amount of options we have. Am I going to go for React? Angular? PHP? Ruby? What about SEO? Should I try node? What them, where do I host? Once you decided and set everything up, you’ve got to list all your projects manually, add the descriptions, links, images and decide on a design that shows your very best. Suddenly, the simple task of creating a pretty portfolio is overwhelming.” -- Pedro Silva Moreira",
		"“The problem is there are no simple ‘right’ answers for most Web design questions (at least not for the important ones). What works is good, integrated design that fills a need — carefully thought out, well executed, and tested.” -- Steve Krug",
		"“If debugging is the process of removing software bugs, then programming must be the process of putting them in.” -- Edsger W. Dijkstra",
		"“Fix the cause, not the symptom.” -- Steve Maguire",
		"“If you’re already a front-end developer, well, pretend you’re also wearing a pirate hat.” -- Ethan Marcotte",
		"“If you think math is hard, try web design.” -- Trish Parr",
		"“There are three responses to a piece of design—Yes, No, and WOW! Wow is the one to aim for.” -- Milson Glaser",
		"“A designer knows he has achieved perfection not when there is nothing left to add, but when there is nothing left to take away.” -- Antoine de Saint-Exupéry",
		"“ The public is more familiar with bad design than good design. It is in effect, conditioned to prefer bad design because that is what it lives with. The new becomes threatening, the old reassuring.” -- Paul Rand",
		"“Designers love subtle cues, because subtlety is one of the traits of sophisticated design. But Web users are generally in such a hurry that they routinely miss subtle cues. […] It doesn’t matter how many times I have to click, as long as each click is a mindless, unambiguous choice.” -- Steve Krug",
		"“What separates design from art is that design is meant to be… functional.” -- Cameron Moll",
		"“It’s not a bug. It’s an undocumented feature!” -- Will J. Doors",
		"“I don’t care if it works on your machine! We are not shipping your machine!” -- Vidiu Platon",
		"“Web design is not just about creating pretty layouts. It’s about understanding the marketing challenge behind your business.” -- Mohamed Saad",
		"“Responsive web design always plays an important role whenever going to promote your website.” -- Josh Wilson",
		"“Simplicity is the soul of efficiency.” -- Austin Freeman",
		"“People tend to think of the web as a way to get information or perhaps as a place to carry out ecommerce. But really, the web is about accessing applications. Think of each website as an application, and every single click, every single interaction with that site, is an opportunity to be on the very latest version of that application.” -- Marc Andreesen",
		"“Don’t forget: when you start a website, it’s not yet a trusted site. So you have to bring people from a trusted site to your site to build up the trust in your site.” -- James Altucher",
		"“Most sites need to prevent breadth — many many pages that are organized cohesively. A site that presents a single webpage is unlikely to present sufficient depth of content to justify extensive SEO.” -- Harold Davis",
		"“Impactful SEO is rarely executed by a lone wolf.” -- Jes Scholz",
		"“Commit to a niche. Try to stop being everything to everyone.” -- Andrew Davis",
		"“Any fool can write code that a computer can understand. Good programmers write code that humans can understand.” -- Martin Fowler",
		"“ In order to be irreplaceable, one must always be different.” -- Coco Chanel",
		"Today it’s not about, “Get the Traffic,” it’s about “Get the targeted and relevant traffic.” -- Adam Audette"
	];
}