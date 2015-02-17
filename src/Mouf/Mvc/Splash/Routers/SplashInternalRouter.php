<?php
namespace Mouf\Mvc\Splash\Routers;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Mouf\Mvc\Splash\Services\SplashUtils;

/**
 * This router is internally called by the SplashDefaultRouter, once the route has been decided.
 * It is the last router to send the response, after all filters have been applied.
 *
 */
class SplashInternalRouter implements HttpKernelInterface
{

    /**
     * @param object $controller The controller to be called
     * @param string $action     The action to be called
     * @param array  $args       The arguments to pass to the action
     */
    public function __construct($controller, $action, $args)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->args = $args;
    }

    /**
     * Handles a Request to convert it to a Response.
     *
     * When $catch is true, the implementation must catch all exceptions
     * and do its best to convert them to a Response instance.
     *
     * @param Request $request A Request instance
     * @param int     $type    The type of the request
     *                         (one of HttpKernelInterface::MASTER_REQUEST or HttpKernelInterface::SUB_REQUEST)
     * @param bool    $catch   Whether to catch exceptions or not
     *
     * @return Response A Response instance
     *
     * @throws \Exception When an Exception occurs during processing
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        return SplashUtils::buildControllerResponse(
            function () {
                return call_user_func_array(array($this->controller, $this->action), $this->args);
            }
        );
    }
}
