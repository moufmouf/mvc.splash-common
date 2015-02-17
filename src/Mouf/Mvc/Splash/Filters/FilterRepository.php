<?php
namespace Mouf\Mvc\Splash\Filters;

use Mouf\Mvc\Splash\Routers\SplashInternalRouter;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * This class is in charge of registering all filters that will apply to a request handled by Splash.
 */
class FilterRepository
{

    /**
     * @var FilterFactoryInterface[]
     */
    private $filterFactories = array();

    /**
     *
     * @param FilterFactoryInterface[] $filterFactories
     */
    public function __construct(array $filterFactories = array())
    {
        $this->filterFactories = $filterFactories;
    }

    /**
     * @param  SplashInternalRouter $internalRouter
     * @param $controller
     * @param $action
     * @return HttpKernelInterface
     */
    public function getFilteredInternalRouter(SplashInternalRouter $internalRouter, $controller, $action)
    {
        $reverseFilterFactories = array_reverse($this->filterFactories);

        $router = $internalRouter;

        /* @var $reverseFilterFactories FilterFactoryInterface[] */
        foreach ($reverseFilterFactories as $factory) {
            $newRouter = $factory->getFilter($router, $controller, $action);
            if ($newRouter !== null) {
                $router = $newRouter;
            }
        }

        return $router;
    }
}
