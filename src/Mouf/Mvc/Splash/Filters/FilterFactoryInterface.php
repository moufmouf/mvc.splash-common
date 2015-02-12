<?php
namespace Mouf\Mvc\Splash\Filters;

use Symfony\Component\HttpKernel\HttpKernelInterface;


/**
 * Interface to be extended to add a filter to all actions.
 * FilterFactory objects should be registered in the FilterRepository
 */
interface FilterFactoryInterface
{
	/**
	 * This should return a StackPHP middleware wrapping the $app.
	 *
	 * @param HttpKernelInterface $app The kernel your middleware will be wrapping.
	 * @param object $controller The controller
	 * @param string $action The action of the controller
	 * @return HttpKernelInterface|null
	 */
	public function getFilter(HttpKernelInterface $app, $controller, $action);
}
